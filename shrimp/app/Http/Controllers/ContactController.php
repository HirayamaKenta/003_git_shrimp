<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
//  ↓メール機能のため
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactForm;
//  ↑メール機能のため


class ContactController extends Controller
{
  public function create()
  {
    return view("contact.create");
  }

  public function store(Request $request)
  {
    // ↓バリデーション
    $inputs = request()->validate([
      "title" => "required|max:255",
      "email" => "required|max:255",
      "body" => "required|max:5000",
    ]);
    // ↑バリデーション

    // Contact::create($inputs);
    // ↑同じ
    $contact = new Contact();
    $contact->title = $request->title;
    $contact->email = $request->email;
    $contact->body = $request->body;
    $contact->save();


    //  ↓メール機能のため
    Mail::to(config('mail.admin'))->send(new ContactForm($inputs));
    Mail::to($inputs['email'])->send(new ContactForm($inputs));
//  ↑メール機能のため


    return back()->with("message","お問い合わせをお受けいたしました。". $request->email . " にメールを送信いたしましたのでご確認ください。");
  }
}