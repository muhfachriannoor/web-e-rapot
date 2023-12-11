<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
  use AuthenticatesUsers;
  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
  /**
   * Get the failed login response instance.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Symfony\Component\HttpFoundation\Response
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function sendFailedLoginResponse(Request $request)
  {
    throw ValidationException::withMessages([
      'username' => [trans('auth.failed')],
    ]);
  }
  /**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  // public function username()
  // {
  //     $login = request()->input('username');
  //     $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
  //     request()->merge([$field => $login]);
  //     return $field;
  // }
  public function login(Request $request)
  {
    $this->validate($request, [
      'username' => 'required|string', //VALIDASI KOLOM USERNAME
      //TAPI KOLOM INI BISA BERISI EMAIL ATAU USERNAME
      'password' => 'required|string',
    ]);

    //LAKUKAN PENGECEKAN, JIKA INPUTAN DARI USERNAME FORMATNYA ADALAH EMAIL, MAKA KITA AKAN MELAKUKAN PROSES AUTHENTICATION MENGGUNAKAN EMAIL, SELAIN ITU, AKAN MENGGUNAKAN USERNAME
    $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    //TAMPUNG INFORMASI LOGINNYA, DIMANA KOLOM TYPE PERTAMA BERSIFAT DINAMIS BERDASARKAN VALUE DARI PENGECEKAN DIATAS
    $login = [
      $loginType => $request->username,
      'password' => $request->password
    ];

    //LAKUKAN LOGIN
    if (auth()->attempt($login)) {
      //JIKA BERHASIL, MAKA REDIRECT KE HALAMAN HOME
      $request->session()->all();
      return redirect()->route('dashboard');
      //if (auth()->user()->level == 1) {
      //  return redirect()->route('dashboard');
      //}
    }
    //JIKA SALAH, MAKA KEMBALI KE LOGIN DAN TAMPILKAN NOTIFIKASI 
    return redirect()->route('halaman-login')->with(['error' => 'Username/Password salah!']);
  }
  public function logout(Request $request)
  {
    $this->guard()->logout();
    $request->session()->invalidate();
    return redirect('/');
  }
}
