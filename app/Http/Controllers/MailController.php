<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function send()
    {
        Mail::chunk(5, function ($data){
            dispatch(new SendMail($data));
        });
        return response()->json('send mails in background');
    }
}
