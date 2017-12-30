<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::dashboardListing();

        return view('minimal.pages.home')
            ->with('categogies', $categories);
    }

    public function getInactivePage()
    {
        return view('minimal.pages.auth.inactive');
    }
}
