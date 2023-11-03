<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Hash;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Mail\ForgetPasswordMail;

// use Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class AuthCont extends Controller
{
    public function login(){
        // dd(Hash::make(123456));
        if(!empty(Auth::check())){
          if(Auth::user()->user_type ==1 ){
            return redirect('admin/dashboard');
          }
          else if(Auth::user()->user_type ==2 ){
            return redirect('teacher/dashboard');
          }
          else if(Auth::user()->user_type ==3 ){
            return redirect('student/dashboard');
          }
          else if(Auth::user()->user_type ==4 ){
            return redirect('parent/dashboard');
          }
        }
        return view('auth.login');
    }

    // login validation

    public function AuthLogin(Request $request){
      $remember =!empty($request->remember) ? true: false;
      if(Auth::attempt(['email' => $request->email,  'password' => $request->password, 'is_delete'=>0],  true)){
            if(Auth::user()->user_type ==1 ){
                return redirect('admin/dashboard');
              }
              else if(Auth::user()->user_type ==2 ){
                return redirect('teacher/dashboard');
              }
              else if(Auth::user()->user_type ==3 ){
                return redirect('student/dashboard');
              }
              else if(Auth::user()->user_type ==4 ){
                return redirect('parent/dashboard');
              }


      }else{
        return redirect()->back()->with('error', 'Incorrect Email or Password');
      }
    }
    public function forgotpassword(){
      return view('auth.forgot');
    }
    public function PostForgotPassword(Request $request){
      $user = User::getEmailSingle($request->email);
      if(!empty($user)){
        $user -> remember_token = Str::random(30);
        $user -> save();

        Mail::to($user -> email)->send(new ForgetPasswordMail($user));

        return redirect()->back()->with('success', "Please check your mail and reset your password!");
      }
      else{
        return redirect()->back()->with('error', "Email not registered!");
      }
    }
    public function reset($remember_token){
      $user = User::getTokenSingle($remember_token);
      if(!empty($user)){
        $data['user']= $user;
        return view('auth.reset', $data);
      }else{
        abort(404);
      }
    }

    public function PostReset($token, Request $request){
       if($request -> password == $request->cpassword){
        $user = User::getTokenSingle($token);
        $user->password = Hash::make($request -> password);
        $user ->remember_token = Str::random(30);
        $user-> save();

        return redirect(url(''))->with('success', "Password Successfully Reset.");
       }else{
        return redirect()->back()->with('error', "Password does not match!");
       }
    }
    public function logout(){
        Auth::logout();
        return redirect(url(''));
    }
}
