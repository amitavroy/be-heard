<?php

namespace App\Http\Controllers\Auth;

use App\Jobs\User\UserHasLoggedIn;
use App\Jobs\User\UserRegistSuccessful;
use App\Mail\Invite\InvitedUserRegistered;
use App\Models\Invite;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getInvitedPage($token, Request $request)
    {
        if (!$invite = Invite::where('token', $token)->first()) {
            abort('400', 'What are you looking for?');
        }

        if ($invite->expire_at < Carbon::now()) {
            abort('400', 'The token has expired. You can request for a fresh invite.');
        }

        $request->session()->forget('invite');
        $request->session()->put('invite', $invite->token);

        return view('minimal.pages.auth.user-register')
            ->with('invite', $invite);
    }

    public function saveUser(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'password' => 'required|min:6',
            'c_password' => 'required|min:6|same:password',
        ]);

        $token = $request->session()->get('invite');

        if (!$invite = Invite::where('token', $token)->first()) {
            abort('400', 'What are you looking for?');
        }

        $request->session()->forget('invite');

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $invite->email,
            'password' => bcrypt($validatedData['password']),
            'active' => 1
        ]);

        $invite->used = 1;
        $invite->save();

        Auth::loginUsingId($user->id);
        UserHasLoggedIn::dispatch($user);
        UserRegistSuccessful::dispatch($user);

        flash('Welcome to Be-heard');
        return redirect(route('home'));
    }
}
