<?php
// app/Http/Controllers/AuthController.php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EditUserRequest;
use Illuminate\Support\Facades\DB;
use FFI\Exception;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * verify login by user
     *
     * @param  LoginRequest $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized'
            ],
            Response::HTTP_UNAUTHORIZED);
        }
 
        $user = Auth::user(); 
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
 
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
 
        $token->save();
 
        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
 
    /**
     * 
     *  get data user
     * 
     * @return  Ressponse
     * 
     */
    public function profile()
    {
        $user = Auth::user(); 
        return response()->json(
            [
                'status'=> Response::HTTP_OK,
                'msg' => "Message",
                'data' => $user
            ],
        );
        
    }
    /**
     * update user
     * 
     * @param EditUserRequest $request
     * 
     * @return Respone 
     */
    public function update(EditUserRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = Auth::user(); 
            $user->email = $request->email;
            $user->name = $request->name;
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->birthday = $request->birthday;
            $user->status = $request->status;

        
            $user->save();

            DB::commit();

            return response()->json(
                [
                    'status'=> Response::HTTP_OK,
                    'msg' => "Message",
                    'data' => $user
                ],
        );
        
        } catch (Exception $e) {
            DB::rollBack();
        }
            
        
    }

}