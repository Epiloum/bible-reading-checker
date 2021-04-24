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
            $tickets = Ticket::with(['user', 'book'])->get();
        } else {
            $tickets = Ticket::with(['user', 'book'])
                ->where('user_id', auth()->user()->id)
                ->get();
        }

        // Postprocessing data
        $tickets = $tickets->map(function ($item, $key) {
            return collect([
                'no' => $item->id,
                'division' => $item->user->division,
                'mobile' => substr($item->user->mobile, -4),
                'book' => $item->book->title,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('Y/m/d'),
                'month' => Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->month
            ]);
        });

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
