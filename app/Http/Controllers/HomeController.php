<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        dd(Auth::user());
        return view('minimal.pages.home');
    }

    public function getInactivePage()
    {
        return view('minimal.pages.auth.inactive');
    }
}
