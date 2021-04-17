<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{  
    /**
    * view login by user
    *
    * 
    * @return Response
    */
   public function showFormLogin()
   {
       return view('user.auth.login');
   } 
    /**
     * verify login by user
     *
     * @param  LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            'email' => $request->email, 
            'password' =>$request->password,
            'status'=>CONFIRM
            ])) {
            return redirect()->route('category');
        } 
        else {
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            return redirect()->back()->withInput();
        }
    }
    /**
     * logout by user
     *
     * @param  
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}

