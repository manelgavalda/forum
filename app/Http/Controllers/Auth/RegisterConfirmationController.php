<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;

class RegisterConfirmationController extends Controller
{
    public function index()
    {
        $user = User::whereConfirmationToken(request('token'))->first();

        if (! $user) {
            return redirect('/threads')->with('flash', 'Unknown token.');
        }

        $user->confirm();

        return redirect('/threads')
            ->with('flash', 'Your account is now confirmed! You may pst to the forum.');
    }
}
