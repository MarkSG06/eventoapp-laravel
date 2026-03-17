<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MySQL\Language;

class HomeController extends Controller
{
    public function index()
    {
        $languages = Language::where('active', true)->get();

        return view('front.welcome', compact('languages'));
    }

	
}