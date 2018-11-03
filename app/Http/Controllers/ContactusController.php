<?php

namespace App\Http\Controllers;

use App\Contactus;
use App\Mail\ContactusMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactusController extends Controller
{
    public function index()
    {
        return view('contactus');
    }

    public function send(Contactus $contact)
    {
        $this->validate(request(), [
           'name'   => 'required',
           'email'  => 'required',
           'mobile' => 'required|max:11',
           'body'   => 'required'
        ]);

        $contact->create(request(['name', 'email', 'mobile', 'body']));
        session()->flash('message', 'پیام با موفقیت ارسال شد.');
        return redirect('contactus');
    }

    public function showmessage(Contactus $contactus)
    {
        $contactuss = $contactus->latest()->paginate(10);
        return view('panel.contactus', compact('contactuss'));
    }

    public function answermessage($id)
    {
        $contactuss = Contactus::get()->where('id', $id);
        return view('panel.answermessage', compact('contactuss'));
    }

    public function mailsending(Contactus $contactus, Request $request)
    {
        $this->validate(request(), [
           'email' => 'required',
           'body'  => 'required'
        ]);
        $user  = $contactus->user();
        $body  = request('body');
        $email = request('email');
        Mail::to($email)->send(new ContactusMail($user, $body));
        $contactus->update(['answer' => 1]);
        session()->flash('message', 'پاسخ ایمیل با موفقیت برای کاربر ارسال شد.');
        return redirect('panel/contactus');
    }
}
