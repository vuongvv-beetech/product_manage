<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
     /**
     * view login by admin
     *
     * 
     * @return Response
     */
    public function showFormLogin()
    {
        return view('admin.auth.login');
    }
    /**
     * verify login by admin
     *
     * @param  Rquest $request
     * @return Response
     */
    public function login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.index');
        } 
        else {
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            return redirect()->back();
        }
    }
     /**
     * verify logout
     *
     * @param
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('admin.login');
    }
}