<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MySQL\Language;

class ChangeController extends Controller
{
    public function index(Request $request)
    {
        app()->setLocale($request->language);
    }
}