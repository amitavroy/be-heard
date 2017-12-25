<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InviteController extends Controller
{
    public function index()
    {
        $invites = Invite::where('user_id', Auth::user()->id)->paginate(20);

        return view('minimal.pages.invites.invite-index')
            ->with('invites', $invites);
    }
}
