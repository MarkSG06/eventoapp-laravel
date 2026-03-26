<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MongoDB\Faq;
use App\Models\MySQL\Language;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
				$languages = Language::where('active', true)->get();

        return view('front.welcome', compact('faqs', 'languages'));
    }
}