<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class CustomAuthController extends Controller
{
 public function __construct(){
    $this->middleware(middleware:'guest')->except(methods:[
        'logout',
        'dashboard',
    ]);
 }
 public function register(){
    return view('auth.register');
 }
 public function store(Request $request){

     $request->validate(rules:[
         'email' => 'required|email|max:250|unique:users',
         'name' => 'required|string|max:250',
         'family' => 'required|string|max:250',
         'password' => 'required|min:8|confirmed',
         ]) ;
User::create([
    'name' =>$request->name,
    'family' =>$request->family,
    'email' => $request->email,
    'password' => Hash::make($request->password),
]);
$credentials=$request->only(['password','email']);

Auth::attempt($credentials);
$request->session()->regenerate();
return redirect()->route('user.register')->withSuccess('شما با موفقیت ثبت نام و لاگین شدید!');

}
public function login(){
    return view('auth.login');
}
public function authenticate(Request $request){
    $credentials=$request->validate([
        'email' => 'required|email|max:250',
        'password' => 'required|string|max:250',
    ]);
    if(Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect(Route('home'));
    }
    return back()->withErrors();
}
public function dashboard(){
    if(Auth::check()){
        return view('auth.dashboar');
    }
    return redirect()->back();
}
public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('user.login')->withSuccess('شما با موفقیت خارج شدید');
}

}
