<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use App\Models\Etoken;
use DB;
use App\Http\Controllers\GeneralController;

class AuthController extends Controller
{
	public function __construct()
    {
      $this->generalController = new GeneralController;
    }
  /**
  * Create user
  *
  * @param  [string] name
  * @param  [string] email
  * @param  [string] password
  * @param  [string] password_confirmation
  * @return [string] message
  */
  public function register(Request $request)
    {


        $validator =  Validator::make($request->all(),[
            'username'=>'required|min:4|unique:users,username',
            'email'=>'required|string|unique:users',
            'password'=>'required|string',
            'c_password' => 'required|same:password',
            'role'=>'required'
        ]);

         if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        $user = new User([
        'username'=>$request->username,
        'name'  => isset($request->name)?$request->name:'',
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
        ]);

        $user->save();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->plainTextToken;
		$log_data['type']='event';
		$log_data['user_id']=$user->id;
		$log_data['action_id']=$user->id;
		$log_data['message']=$request->email." made a registration";
		$this->generalController->logs($log_data);
        return response()->json(['status'=>201,  'message' => 'Successfully created user!','accessToken'=> $token,  'refreshToken' =>$token,'data' =>$user]);

    }

/**
 * Login user and create token
*
* @param  [string] email
* @param  [string] password
* @param  [boolean] remember_me
*/

public function login(Request $request)
{
    $validator =  Validator::make($request->all(),[
    'username' => 'required|string',
    'password' => 'required|string',
    'remember_me' => 'boolean'
    ]);

    if($validator->fails()){
        return response()->json([
            "error" => 'validation_error',
            "message" => $validator->errors(),
        ], 422);
    }

    $credentials = request(['username','password','role']);
    if(!Auth::attempt($credentials))
    {
    return response()->json([
        'message' => 'Unauthorized'
    ],422);
    }

    $user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->plainTextToken;
	if($request->role == 2){
		$users =DB::table('users')
		->leftjoin('teachers','users.id','=','teachers.user_id')
		->where('users.id',$user->id)
		->get()->first();
	}else if($request->role == 3){
		$users =DB::table('users')
		->leftjoin('parents','users.id','=','parents.user_id')
		->where('users.id',$user->id)
		->get()->first();
	}else if($request->role == 4){
		$users =DB::table('users')
		->leftjoin('students','users.id','=','students.user_id')
		->where('users.id',$user->id)
		->get()->first();
	} else {
		$users =$request->user();
	}
    return response()->json([
    'accessToken' =>$token,
    'token_amount' =>Etoken::where('user_id', $user->id)->sum('token_amount'),
    'refreshToken' =>$token,
    'data' =>$users,
    'token_type' => 'Bearer',
    ]);
}

public function user(Request $request)
{
    return response()->json($request->user());
}

public function logout(Request $request)
{
    $request->user()->tokens()->delete();

    return response()->json([
    'message' => 'Successfully logged out'
    ]);

}


}
