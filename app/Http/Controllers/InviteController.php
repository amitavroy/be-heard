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

    public function create()
    {
        return view('minimal.pages.invites.invite-add');
    }

    public function store(Request $request)
    {
        $emails = explode(PHP_EOL, $request->input('emails'));

        foreach ($emails as $key => $email) {
            // code reference taken from stackoverflow
            //https://stackoverflow.com/questions/4865835/how-can-characters-n-t-r-be-replaced-with
            $regex = '/(\s|\\\\[rntv]{1})/';
            $emails[$key] = preg_replace($regex, '', $email);
        }

        dd($emails);
        return $request->all();
    }
}
