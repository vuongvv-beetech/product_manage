<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\Http\Requests\EditUserRequest;
use App\Mail\MailConfirmUser;
use App\Models\Commune;
use App\Models\District;
use App\Models\Province;
use App\Services\ServiceProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FFI\Exception;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use App\Models\PasswordReset;


class UserController extends Controller
{
    protected $serviceProduct;

    public function __construct(ServiceProduct $serviceProduct)
    {
        $this->serviceProduct = $serviceProduct;
    }
    /**
     * view all user
     * 
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request){
        $nameSearch = $request->name_user;
        $users = new User();
        $users = $users::where('flag_delete', User::IN_ACTIVE)
        ->select(
            'id',
            'email',
            'name',
            'birthday',
            'first_name',
            'last_name',
            'created_at',
            'status');
        if($request->has('name_user')){
            $users = $users
                    ->where('name','like',"%$nameSearch%")
                    ->orwhere('email','like',"%$nameSearch%")
                    ->orwhere('first_name','like',"%$nameSearch%")
                    ->orwhere('last_name','like',"%$nameSearch%");
        }

        $users= $users->paginate(PAGINATE_USER);
        return view('admin.index',['users'=>$users]);
    }
        
    /**
     * view add user
     *
     * @return Response
     */
    public function create()
    {
        $provinces = Province::select(
            'id',
            'name'
        )->get();
        return view('admin.user.create',['provinces'=>$provinces]);
    }
    /**
     * get data district
     *
     * @param int $id
     *
     * @return Response
     */
    public function getDistrict($id)
    {
        $data = District::select(
            'id',
            'name'
        )->where('province_id','=',$id)
        ->get();
        return $data;
    }
    /**
     * get data commune
     *
     * @param int $id
     *
     * @return Response
     */
    public function getCommune($id)
    {
        $data = Commune::select(
            'id',
            'name'
        )->where('district_id','=',$id)
        ->get();
        return $data;
    }
    /**
     * add user
     *
     * @param UserRequest $request
     *
     * @return add new user
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try{
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->birthday = $request->birthday;
            $user->status = $request->status;
            $user->address = $request->address;
            $user->province_id = $request->province;
            $user->district_id = $request->district;
            $user->commune_id = $request->commune;
    
            #save image user
            $this->serviceProduct->uploadImage(
                                    $request,
                                    $user,
                                    'avatar',
                                    '/upload/user',
                                    'public/upload/user/'
                                );
    
            $user->save();
    
            DB::commit();

            # Send mail
            $token = str_replace("/","a",Hash::make(Str::random(60)));
        
            $passwordGet = new PasswordReset();

            $passwordGet->email = $user->email;

            $passwordGet->token = $token;
    
            $passwordGet->created_at = Carbon::now()->addHours(3);
    
            $passwordGet->status = UNUSED;
    
            $passwordGet->save();
        
            
    
            Mail::to($user->email)->send(new MailConfirmUser($token));
            
            Alert::success('Success Title', 'Success Message');
            return redirect()->route('admin.index')
            ->with('message', 'Add user successfully');
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * view user edit
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id){
        $provinces = Province::select(
            'id',
            'name'
        )->get();
        $users = User::select(
            'id',
            'email',
            'name',
            'first_name',
            'last_name',
            'birthday',
            'status',
            'address',
            'province_id',
            'district_id',
            'commune_id',
            'avatar'
        );
        $user = $users
                ->where('id',$id)
                ->with('userProvince')
                ->with('userDistrict')
                ->with('userCommune')
                ->first();
        $districts = $this->getDistrict($user->userProvince->id);
        $communes = $this->getCommune($user->userDistrict->id);
        // dd($communes);
        return view('admin.user.edit',['user'=>$user,'provinces'=>$provinces,'districts'=>$districts,'communes'=>$communes]);
    }
    /**
     *  view change password
     * 
     * @param string $token
     * 
     * @return Response
     */
    public function changePass($token){
        return view('admin.user.confirm-password')->with(['token'=>$token]);
    }

    /**
     * edit user
     *
     * @param EditUserRequest $request
     * @param int $id
     *
     * @return edit user
     */
    public function update(EditUserRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $user = User::find($id);

            $user->email = $request->email;
            $user->name = $request->name;
            $user->first_name = $request->firstname;
            $user->last_name = $request->lastname;
            $user->birthday = $request->birthday;
            $user->status = $request->status;
            $user->address = $request->address;
            $user->province_id = $request->province;
            $user->district_id = $request->district;
            $user->commune_id = $request->commune;
    
            // save image user
            $this->serviceProduct->uploadImage(
                                    $request,
                                    $user,
                                    'avatar',
                                    '/upload/user',
                                    'public/upload/user/'
                                );
            
            $user->save();
            
            // Send mail
            $message = [
                'type' => 'Update user',
                'user' => $user->name,
                'content' => 'has been done',
            ];
            DB::commit();
           
            SendEmail::dispatch($message, $user); 
            Alert::success('Post Created', 'Successfully');
            return redirect()->route('admin.index')->with('message', 'Update user successfully');
        } catch (Exception $e) {
            DB::rollBack();
        }
        
    }
    /**
     * delete user
     *
     * @param $id
     *
     * @return delete user by id
     */
    public function destroy($id)
    {
        $user = User::select(
            'id',
            'flag_delete'
        )
        ->where('id', $id)
        ->first();
        if($user)
        {
            DB::beginTransaction();
            try{
                $user->update(['flag_delete' => User::ACTIVE]);
                DB::commit();
                return response()->json();
            } catch (Exception $e) {
                DB::rollBack();
            } 
        }
        else{
            Alert::error('Error ', 'Error Message');
        }
        
    }
     /**
     * check user
     *
     * @param Request $request
     *
     * @return Response
     */
    public function checkUser(Request $request)
    {
        if($request->email)
        {
            $user = User::where("email",$request->email)
            ->select('email')->first();
            if($user)
                return "false";
            else return "true";
        }
    }

}
