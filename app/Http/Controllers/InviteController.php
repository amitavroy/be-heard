<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use App\Service\Invites\SendInviteService;
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

    public function store(Request $request, SendInviteService $inviteService)
    {
        $emails = explode(PHP_EOL, $request->input('emails'));

        // code reference taken from stackoverflow
        //https://stackoverflow.com/questions/4865835/how-can-characters-n-t-r-be-replaced-with
        $regex = '/(\s|\\\\[rntv]{1})/';
        $emails = preg_replace($regex, '-', $emails);
        $emails = explode('--', $emails[0]);

        if (!$inviteService->sendInvites($emails)) {
            flash()->error('Invites were not sent. Try again.');
        }

        flash('Invites sent successfully');

        return redirect(route('invite'));
    }
}
