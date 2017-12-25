<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('minimal.pages.home');
    }

    public function getInactivePage()
    {
        return view('minimal.pages.auth.inactive');
    }
}
