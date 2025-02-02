<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{

  /**
   * Display the login view.
   *
   * @return \Illuminate\View\View
   */
  public function create()
  {
    // Versionの確認1_2025/01/18 14:01
    // Versionの確認2_2025/01/18 14:40
    // Versionの確認3_2025/01/18 14:40
    // Versionの確認4_2025/01/19 13:41
    // Versionの確認5_2025/01/19 13:48
    // Versionの確認6_2025/01/19 13:49
    // testブランチでの変更1
    // testブランチでの変更2
    // メインでの変更20250119_1436
    // メインでの変更20250119_1518
    // test2ブランチでの変更1
    // メインでの変更20250119_1554
    // test2ブランチでの変更2
    return view('auth.login');
  }


  /**
   * Handle an incoming authentication request.
   *
   * @param  \App\Http\Requests\Auth\LoginRequest  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(LoginRequest $request)
  {
    // ブランチテスト1
    // ブランチテスト2
    // ブランチテスト3
    // ↓パスコード認証追加分
    if ($request->passcode !== "05110511") {
      return redirect()->back()->with("message", "passcodeは制作者に提示されたものを打ち込んでください。");
    }
    // ↑パスコード認証追加分


    $request->authenticate();

    $request->session()->regenerate();

    return redirect()->intended(RouteServiceProvider::HOME);
  }

  /**
   * Destroy an authenticated session.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy(Request $request)
  {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
