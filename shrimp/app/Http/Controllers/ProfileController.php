<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
  public function index()
  {
    $users = User::all();
    return view("profile.index", compact("users"));
  }

  public function edit(User $user)
  {
    $this->authorize("update", $user);
$roles=Role::all();
    return view("profile.edit", compact("user","roles"));
  }

  public function update(User $user, Request $request)
  {
    $this->authorize("update", $user);

    // ↓バリデーション
    $inputs = request()->validate([
      'name' => 'required|max:255',
      'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
      'avatar' => 'image|max:10000',
      'password' => 'nullable|max:255|min:8',
      'password_confirmation' => 'nullable|same:password'
    ]);
    // ↑バリデーション

    // ↓パスワードの設定
    if (!isset($inputs["password"])) {
      unset($inputs["password"]);
    } else {
      $inputs["password"] = Hash::make($inputs["password"]);
    }
    // ↑パスワードの設定

    // ↓アバターの保存
    if (isset($inputs['avatar'])) {
      if ($user->avatar !== "user_default.jpg") {
        $old_avatar = "public/images/" . $user->avatar;
        Storage::delete($old_avatar);
      }
      $name = request()->file('avatar')->getClientOriginalName();
      $avatar = date('Ymd_His') . '_' . $name;
      request()->file('avatar')->storeAs('public/images', $avatar);
      $inputs['avatar'] = $avatar;
    }
    // ↑アバターの保存

    $user->update($inputs);
    return back()->with('message', $request->name . 'さんの情報を更新しました');
  }

public function delete(User $user){
$user->roles()->detach();
if($user->avatar!=="user_default.jpg"){
  $old_avatar="public/images/" . $user->avatar;
  Storage::delete($old_avatar);
}
$user->delete();
  return back()->with("message","「".$user->name . "」さんのアカウントを削除しました。");
}


}