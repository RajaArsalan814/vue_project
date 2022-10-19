<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parents;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;

class ParentsController extends Controller
{
    public function create(Request $request)
    {
		try{

        $validator =  Validator::make($request->all(),[
            'fullname' => 'required',
            'gender'=>'required',
            'date_of_birth'=>'required',
            'state'=>'required',
            'city' => 'required',
            'phone_number'=>'required',
            'number_of_kids'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        }
         
       DB::beginTransaction();

        $user_id = $request->user('sanctum')->id;
       $parents = Parents::updateOrCreate(
        ['user_id' =>$user_id],
        ['fullname' => $request->fullname,
         'gender' => $request->gender,
         'state'=>$request->state,
         'city'=>$request->city,
         'date_of_birth'=>$request->date_of_birth,
         'phone_number'=>$request->phone_number,
         'number_of_kids'=>$request->number_of_kids]
    );
    
        if($parents->save())
        { 
             DB::commit();
            return response()->json(['message'=>'Parents Created Successfully!'],200);
        }else  
        {
         return response()->json(['status'=>400,$request->validator->fails()]);
        }
                    
       
    }catch(\Exception $e){
        DB::rollback();	
         return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
     }
     
 }
 public function parents(Request $request)
 {
     try{
         //$parents = Parents::all();;
		   $filter = $request->query('q');
			if (!empty($filter)) {
				$parents =DB::table('users') 
				->leftjoin('parents','users.id','=','parents.user_id')
				->where('users.role',3)->where('parents.fullname', 'like', '%'.$filter.'%')
				->paginate(10);
			} else {
			$parents =DB::table('users') 
			->leftjoin('parents','users.id','=','parents.user_id')
			->where('users.role',3)
			->paginate(10);
			}
			$p =array();
			foreach($parents as $parent){
				$parent->token = DB::table('e_tokens') ->where('user_id', $parent->user_id)->sum('token_amount');
				//$p[] = $parent;
			}
		// print_r($p);
         return response()->json(array(
             'status' => 'success',
             'pages' => $parents->toArray()),
             200
         );
     }catch(\Exception $e){
         DB::rollback();	
         return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
     }
  
  }
}
