<?php

namespace App\Console;

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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // 완독시 추첨권 생성
        $schedule->call(function() {
            // TODO - 별도 Service로 분리
            $periodMinutes = 2;

            // 최근 5분간 생성된 읽기체크 내역을 쿼리
            $targets = \App\Models\Read::with('chapter', 'chapter.book')
                ->whereBetween('created_at', [now()->subMinutes($periodMinutes), now()])
                ->get();

            // 동일한 사용자가 동일한 권을 체크한 경우에 대해 중복제거
            $targets = $targets->unique(function ($item) {
                return $item->chapter->book_id . '_' . $item->user_id;
            });

            // 읽기체크된 각 권마다 사용자가 모든 장을 다 읽었는지 확인
            $targets->each(function ($item) {
                $count = \App\Models\Read::where('user_id', $item->user_id)
                    ->whereHas('chapter', function ($q) use ($item) {
                        $q->where('book_id', $item->chapter->book_id);
                    })->count();

                if ($item->chapter->book->count == $count) {
                    // 추첨권 발급처리
                    \App\Models\Ticket::firstOrCreate([
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
