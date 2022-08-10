<?php

namespace App\Http\Controllers;

use App\Mail\invoiceMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('yogawhy8@gmail.com')->send(new invoiceMail($mailData));

        dd("Email is sent successfully.");
    }
}
