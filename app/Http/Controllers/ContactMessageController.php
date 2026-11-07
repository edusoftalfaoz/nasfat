<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function store(Request $request)
    {
        // Hidden "website" field: real visitors never fill it in, bots do.
        if ($request->filled('website')) {
            return redirect(url('/') . '#contact')->with('contact_success', true);
        }

        $data = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:190'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:160'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        ContactMessage::create($data + ['ip_address' => $request->ip()]);

        return redirect(url('/') . '#contact')->with('contact_success', true);
    }
}
