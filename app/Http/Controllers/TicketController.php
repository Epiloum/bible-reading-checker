<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        // Getting tickets of the logged user
        if(auth()->user()->manager == 'y') {
            $tickets = Ticket::with(['user', 'book'])
                ->where('created_at', '>=', now()->subDays(10)->firstOfMonth())
                ->get();

            $tickets = $tickets->groupBy(function ($item) {
                $month = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month;
                return $item->user_id . '_' . $month;
            });
        } else {
            $tickets = Ticket::with(['user', 'book'])
                ->where('user_id', auth()->user()->id)
                ->get();
        }

        // Postprocessing data
        $tickets = $tickets->map(function ($item, $key) {
            $cnt = $item->count();
            $date = $item->max('created_at');

            return collect([
                'no' => $item[0]->id,
                'division' => $item[0]->user->division,
                'mobile' => substr($item[0]->user->mobile, -4),
                'book' => $item[0]->book->title . ($cnt > '1'? ' (외 ' . ($cnt - 1) . '권)': ''),
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d'),
                'month' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->month
            ]);
        })->sortBy('date');

        // Load View
        return view(
            'app/tickets',
            [
                'list' => $tickets,
                'user_id' => auth()->user()->id
            ]
        );
    }
}
