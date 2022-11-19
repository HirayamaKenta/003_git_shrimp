<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PostController;
// use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ChatController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// ↓初期画面route
Route::get('/', function () {
  return view('welcome');
})->name("top");
// ↑初期画面route

require __DIR__ . '/auth.php';






// ログイン後の画面のRoute

// ↓メール認証ありのミドルウェア
// Route::middleware(['verified'])->group(function () {
  // ↑メール認証ありのミドルウェア
  // ↓ログイン済みのユーザーのみがアプリ内に入れる
  Route::middleware(['auth'])->group(function () {


  //↓お問い合わせroute
  Route::get("contact/create", [ContactController::class, "create"])->name("contact.create");
  Route::post("contact/store", [ContactController::class, "store"])->name("contact.store");
// Route::get('contact/create',  [ContactController::class, 'create'])->name('contact.create')->middleware('guest');

//↑お問い合わせroute




  Route::resource('chat', ChatController::class);
  // ↓同じ意味
  // Route::get('chat/create', [ChatController::class, 'create'])->name('chat.create');
  // Route::chat('chat', [ChatController::class, 'store'])->name('chat.store');
  // Route::get('chat/{chat}', [ChatController::class, 'show'])->name('chat.show');
  // Route::get('chat/{chat}/edit', [ChatController::class, 'edit'])->name('chat.edit');
  // Route::patch('chat/{chat}', [ChatController::class, 'update'])->name('chat.update');
  // Route::delete('chat/{chat}', [ChatController::class, 'destroy'])->name('chat.destroy');
  // ↑chatに関するRoute

  // ↓プロフィール編集用Route
  Route::get("profile/{user}/edit", [ProfileController::class, "edit"])->name("profile.edit");
  Route::patch("profile/{user}",[ProfileController::class,"update"])->name("profile.update");
// ↑プロフィール編集用Route


  // ↓Gateの追加
  Route::middleware(['can:admin'])->group(function () {
    // ↓管理者画面用
    Route::get("profile/index", [ProfileController::class, "index"])->name("profile.index");
    Route::delete("profile/{user}",[ProfileController::class,"delete"])->name("profile.delete");
    Route::patch("role/{user}/attach",[RoleController::class,"attach"])->name("role.attach");
    Route::patch("role/{user}/detach",[RoleController::class,"detach"])->name("role.detach");

    // ↑管理者画面用
  });
  // ↑Gateの追加
});
  // ↑ログイン済みのユーザーのみがアプリ内に入れる