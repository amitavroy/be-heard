<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function test(Request $request)
    {
//        \Log::info($request->all());
        \Log::info('hello');
    }
}
