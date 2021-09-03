<?php

namespace App\Console;

use App\Models\Chapter;
use App\Models\Read;
use App\Models\Ticket;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 완독시 추첨권 생성
        $schedule->call(function() {
            // TODO - 별도 Service로 분리
            $periodMinutes = 2;

            // 최근 5분간 생성된 읽기체크 내역을 쿼리
            $targets = Read::with('chapter', 'chapter.book')
                ->whereBetween('created_at', [now()->subMinutes($periodMinutes), now()])
                ->get();

            // 동일한 사용자가 동일한 권을 체크한 경우에 대해 중복제거
            $targets = $targets->unique(function ($item) {
                return $item->chapter->book_id . '_' . $item->user_id;
            });

            // 읽기체크된 각 권마다 사용자가 모든 장을 다 읽었는지 확인
            $targets->each(function ($item) {
                // 읽기완료 Flag
                $cleared = true;

                // 해당 권의 장별 Primary Key
                $chapter = Chapter::where('book_id', $item->chapter->book_id)->get();

                // 장별로 읽기체크가 되었는지 확인
                $chapter->each(function ($chapter) use ($item, &$cleared) {
                    $res = Read::where('user_id', $item->user_id)
                        ->where('chapter_id', $chapter->id)
                        ->count();

                    // 한 장이라도 읽은 적이 없다면 Flag를 false로 변경
                    $cleared = $cleared && ($res > 0);
                });

                // 추첨권 발급처리
                if ($cleared) {
                    Ticket::firstOrCreate([
                        'book_id' => $item->chapter->book_id,
                        'user_id' => $item->user_id
                    ]);
                }
            });
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
