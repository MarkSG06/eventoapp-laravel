<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MongoDB\Ticket;
use App\Models\MySQL\Language;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
				$languages = Language::where('active', true)->get();

        return view('front.tickets', compact('tickets', 'languages'));
    }

		public function show($title)
		{
			$ticket = Ticket::where('locale.' . app()->getLocale() . '.title', $title)->first();
			$languages = Language::where('active', true)->get();

			return view('front.ticket', compact('ticket', 'languages'));
		}
}