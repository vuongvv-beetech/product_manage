<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailResetPassword;

class ResetPasswordController extends Controller
{
    /**
     *  view forgot password
     * 
     * @return Response
     */
    public function forgotPassword(){
        return view('user.auth.forgot_password');
    }
    /**
     *  request reset password
     * 
     * @param Request $request
     * @return Response
     */
    public function sendMail(Request $request){
        $request->validate(['email' => 'required|email']);
        $user = User::select(
            'email'
            )->where('email','=',$request->email)
            ->first();

        If(!$user){
            return redirect()->back()->with(['error'=>'Mở email để nhập mật khẩu']);
        }
        $token = str_replace("/","a",Hash::make(Str::random(60)));
        
        $passwordReset = PasswordReset::where('email','=',$request->email)
        ->first();
        if($passwordReset){
            $passwordReset->email = $user->email;

            $passwordReset->token = $token;
    
            $passwordReset->created_at = Carbon::now()->addHours(3);
    
            $passwordReset->status = UNUSED;
    
            $passwordReset->save();
        }
        else{
            $passwordGet = new PasswordReset();

            $passwordGet->email = $user->email;

            $passwordGet->token = $token;
    
            $passwordGet->created_at = Carbon::now()->addHours(3);
    
            $passwordGet->status = UNUSED;
    
            $passwordGet->save();
    
        }
        
        Mail::to($user->email)->send(new MailResetPassword($token));
        
        return redirect()->back()->with(['success'=>'Mở email để nhập mật khẩu']);
    }
    /**
     *  view change password
     * 
     * @param string $token
     * 
     * @return Response
     */
    public function changePass($token){
        return view('user.auth.change_password')->with(['token'=>$token]);
    }
    /**
     *  request change password
     * 
     * @param ResetPasswordRequest $request
     * @return Response
     */
    public function update(ResetPasswordRequest $request)
    {
        $confirm = PasswordReset::where('token' , $request->token)
        ->where('created_at','>=',Carbon::now())
        ->where('status',UNUSED)
        ->select('email','status','token')
        ->first();

        if($confirm)
        {
            $user = User::where('email',$confirm->email)
            ->select('id','password','status')
            ->first();

            $user->password = Hash::make($request->password);
            $user->status = CONFIRM;
            $user->save();

            PasswordReset::where('token',$request->token)
            ->update(['status' => USED]);

            return redirect(route('login'));
        }
        else return back()->with('status','Password reset time has expired!');

    }

}
