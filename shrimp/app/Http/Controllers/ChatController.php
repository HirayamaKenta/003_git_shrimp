<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $chats = Chat::orderBy("created_at", "asc")->get();
    $user = auth()->user();
    return view("chat.create", compact("chats", "user"));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // ↓バリデーション
    $inputs = $request->validate([
      "message" => "max:1000",
      "image" => "max:10000",
      "movie" => "max:10000",
    ]);
    // ↑バリデーション


    $chat = new Chat();
    $chat->message = $request->message;
    $chat->user_id = auth()->user()->id;
    // ↓画像保存の処理
    if (request("image")) {
      $original = request()->file("image")->getClientOriginalName();
      $name = date("Ymd_His") . "_" . $original;
      request()->file("image")->move("storage/images", $name);
      // request()->file("image")->storeAs("public/images",$name);でも可
      $chat->image = $name;
    }
    // ↑画像保存の処理
    $chat->save();
    return redirect()->route("chat.create");
    // ->with("message", $chat->message);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Chat  $chat
   * @return \Illuminate\Http\Response
   */
  public function show(Chat $chat)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Chat  $chat
   * @return \Illuminate\Http\Response
   */
  public function edit(Chat $chat)
  {
    $chat->message = "★1★2★3★4★5★6★7★";
    $chat->image = "";

    // ↓画像保存の処理
    if (isset($chat->image)) {
      $old_image = 'public/images/' . $chat->image;
      Storage::delete($old_image);
    }
    // ↑画像保存の処理
    $chat->save();
    return redirect()
    ->route("chat.create", $chat);

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Chat  $chat
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Chat $chat)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Chat  $chat
   * @return \Illuminate\Http\Response
   */
  public function destroy(Chat $chat)
  {
    //
  }
}