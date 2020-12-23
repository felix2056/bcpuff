<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function sendMail(Request $request)
    {
        // return response($request->all());
        //$email = 'bcpuff.co@gmail.com';

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();

        // return response($input['message']);

        //  Send mail to admin
        Mail::send('emails.sendMail', array(
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'subject' => $input['subject'],
            'content' => $input['message'],
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('bcpuff.co@gmail.com', 'BCPuff')->subject($request->get('subject'));
        });

        return redirect()->back()->with(['success' => 'Your message has been sent! Our team will get back to you!']);
    }
}
