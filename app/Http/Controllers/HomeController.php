<?php

namespace App\Http\Controllers;

use App\Mail\MessagePosted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    #for sending welcome page message
    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required','email', 'max:100'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        Mail::to('softdeveloperrob@outlook.com')->queue(
            new MessagePosted($data)
        );

        return redirect('/')->with('status', 'Message sent.');
    }
}