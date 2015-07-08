<?php

namespace TeachersAsTutors\Http\Controllers;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;
use ReCaptcha\ReCaptcha;
use TeachersAsTutors\Http\Requests;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('contact');
    }

    public function postContact(Request $request, Mailer $mailer)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required|email', 'body' => 'required']);

        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET'));
        $resp      = $recaptcha->verify($request->input('g-recaptcha-response'), $request->getClientIp());

        if (! $resp->isSuccess()) {
            return redirect()->back()->withInput($request->input())->with('captcha_errors',
                $resp->getErrorCodes());
        }

        $email = $request->input('email');
        $name  = $request->input('name');

        $mailer->send('emails.contact', ['body' => $request->input('body')], function ($m) use ($email, $name) {
            $m->from($email, $name);
            $m->to(env('MAIL_TO'))->subject(env('APP_NAME') . ' - Contact Form');
        });

        return redirect()->back()->with('success', true);
    }
}
