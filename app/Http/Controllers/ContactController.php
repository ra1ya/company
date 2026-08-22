<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $recipient = config('mail.contact_to', config('mail.from.address'));

        Mail::raw(
            "Name: {$validated['name']}\nEmail: {$validated['email']}\n\n{$validated['message']}",
            function ($mail) use ($validated, $recipient) {
                $mail->to($recipient)
                    ->replyTo($validated['email'], $validated['name'])
                    ->subject('[Website] '.$validated['subject']);
            }
        );

        return back()->with('contact_status', 'Your message has been sent successfully.');
    }
}
