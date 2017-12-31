<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Conversation;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::dashboardListing();
        $conversations = Conversation::dashboardList(5);

        return view('minimal.pages.home')
            ->with('conversations', $conversations)
            ->with('categogies', $categories);
    }

    public function getInactivePage()
    {
        return view('minimal.pages.auth.inactive');
    }
}
