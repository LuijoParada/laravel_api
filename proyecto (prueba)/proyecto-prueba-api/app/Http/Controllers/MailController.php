<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\ShareMaileable;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'to' => 'required|email',
            'body' => 'required',
        ]);

        $to = $request->input('to');
        $body = $request->input('body');

        Mail::to($to)->send(new ShareMaileable($body));

        return response()->json([
            'message' => 'Email sent successfully',
            'status' => 'success',
        ], 200);
    }
}
