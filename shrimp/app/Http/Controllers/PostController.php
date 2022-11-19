<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $posts = Post::orderBy("created_at", "desc")->get();
    $user = auth()->user();
    return view("post.index", compact("posts", "user"));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // ↓Gate:Controller該当者のみが以降の処理を実行できる。
    //  +αコントローラーをGateで制限した場合、URLでその画面に飛ぶことさえできない。
    // Gate::authorize("admin");
    // ↑Gate:Controller

    return view("post.create");
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
      "title" => "required|max:255",
      "body" => "required|max:1000",
      "image" => "image|max:1024",
    ]);
    // ↑バリデーション


    $post = new Post();
    $post->title = $request->title;
    $post->body = $request->body;
    $post->user_id = auth()->user()->id;
    // ↓画像保存の処理
    if (request("image")) {
      $original = request()->file("image")->getClientOriginalName();
      $name = date("Ymd_His") . "_" . $original;
      request()->file("image")->move("storage/images", $name);
      // request()->file("image")->storeAs("public/images",$name);でも可
      $post->image = $name;
    }
    // ↑画像保存の処理
    $post->save();
    return redirect()->route("post.create")->with("message", "「" . $request->title . "」の記事を新規作成&保存しました。");
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    return view("post.show", compact("post"));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    // ↓policyを適用させる
    $this->authorize("update", $post);
    // ↑policyを適用させる

    return view("post.edit", compact("post"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    // ↓policyを適用させる
    $this->authorize("update", $post);
    // ↑policyを適用させる

    // ↓バリデーション
    $inputs = $request->validate([
      "title" => "required|max:255",
      "body" => "required|max:1000",
      "image" => "image|max:1024",
    ]);
    // ↑バリデーション


    $post->title = $request->title;
    $post->body = $request->body;

    // ↓画像保存の処理
    if (request("image")) {
      $original = request()->file("image")->getClientOriginalName();
      $name = date("Ymd_His") . "_" . $original;
      request()->file("image")->move("storage/images", $name);
      // request()->file("image")->storeAs("public/images",$name);でも可
      $post->image = $name;
    }
    // ↑画像保存の処理
    $post->save();
    return redirect()->route("post.show", $post)->with("message", "「" . $request->title . "」の記事を更新しました。");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    // ↓policyを適用させる
    $this->authorize("delete", $post);
    // ↑policyを適用させる

    $post->comments()->delete();
    if (isset($post->image)) {
      $old_image = 'public/images/' . $post->image;
      Storage::delete($old_image);
    }
    $post->delete();

    return redirect()->route("post.index")->with("message", "「" . $post->title . "」の記事を削除しました。");
  }

  // ↓自分の投稿一覧
  public function mypost()
  {
    $user = auth()->user()->id;
    $posts = Post::where("user_id", $user)->orderBy("created_at", "desc")->get();
    return view("post.mypost", compact("posts"));
  }
  // ↑自分の投稿一覧
  // ↓自分のコメント
  public function mycomment()
  {
    $user = auth()->user()->id;
    $comments = Comment::where("user_id", $user)->orderBy("created_at", "desc")->get();
    return view("post.mycomment", compact("comments"));
  }
  // ↑自分のコメント
}