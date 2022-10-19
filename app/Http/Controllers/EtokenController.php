<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etoken;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\GeneralController; 
class EtokenController extends Controller
{
	public function __construct()
    {
      $this->generalController = new GeneralController; 
    }
    public function store(Request $request){
        try{
            $validator =  Validator::make($request->all(),[
            'token_amount' => 'required|numeric', 
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            } 
			$added_by =$request->user('sanctum')->id;
			$username = User::where('id',$request->user_id)->first();
			if($request->id){ 
				$get_etoken=  Etoken::where('id',$request->id)->get()->first();
				if($get_etoken->token_amount > $request->token_amount){
					$token_amount = $get_etoken->token_amount -  $request->token_amount;
					$log_data['message']= $username->username." is debited with ".$token_amount." etokens.";
				} else {
					$token_amount = $request->token_amount - $get_etoken->token_amount;
					$log_data['message']= $username->username." is deposited with ".$token_amount." etokens.";
				}
				$etoken=Etoken::find($request->id); 
                $etoken->added_by=$added_by;
                $etoken->token_amount=$request->token_amount;
                $etoken->user_id=$request->user_id; 
                $etoken->update();  
				
				$log_data['type']='payment'; 
				$log_data['user_id']=$request->user_id; 
				$log_data['action_id']=$etoken->id; 
				$this->generalController->logs($log_data);
				return response()->json(['status'=>200,'message'=>'Etoken Update Successfully']);
			}else{
				DB::beginTransaction();
				$etoken = new Etoken; 
				$etoken->added_by=$added_by;
                $etoken->token_amount=$request->token_amount;
                $etoken->user_id=$request->user_id; 
				$etoken->save();
				DB::commit();
				$log_data['type']='payment'; 
				$log_data['user_id']=$request->user_id; 
				$log_data['action_id']=$etoken->id; 
				$log_data['message']= $username->username." is deposited with ".$request->token_amount." etokens.";
				$this->generalController->logs($log_data);
				
				return response()->json(['status'=>200,'message'=>'Etoken Created Successfully']);
			}
		
    
        }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
        
    }
    
    
    public function show(Request $request,$id)
    {
        try{ 
			$filter = $request->query('q');
			if (!empty($filter)) {
				//$etoken = Etoken::where('user_id', $id)->where('token_amount', 'like', '%'.$filter.'%')->paginate(10);
				$etoken = Etoken::select("e_tokens.*", "users.username") 
				->leftjoin('users','users.id','=','e_tokens.added_by')
				->where('e_tokens.token_amount', 'like', '%'.$filter.'%')
				->where('users.username', 'like', '%'.$filter.'%')
				->where('e_tokens.user_id',$id)
				->paginate(10);
			} else {
				//$etoken = Etoken::where('user_id', $id)->paginate(10);
				$etoken = Etoken::select("e_tokens.*", "users.username") 
				->leftjoin('users','users.id','=','e_tokens.added_by') 
				->where('e_tokens.user_id',$id)
				->paginate(10);
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $etoken
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
     }
    public function search()
    {
        try{ 
			$etoken = Etoken::get(); 
            return response()->json(array(
                'status' => 'success',
                'data' => $etoken
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
     }

    public function update(Request $request,$id)
    {
        try{
            $etoken=Etoken::find($id);
            if( $etoken){ 
                $etoken->url=$request->url;
                $etoken->title=$request->title;
                $etoken->type=$request->type;
                $etoken->classroom_id=$request->classroom_id;
                $etoken->update();  
           
                return response()->json(['status'=>200,'message'=>'Etoken Updated Successfully']);
            }else{
                return response()->json(['status'=>404,'message'=>'Etoken not Found']);
            }
            
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
                 
         
    }

    public function destroy($id) {

        try{
        $etoken = DB::table('e_tokens')->where('id', $id)->delete(); 
        return response()->json(['status'=>200,'message'=>'Etoken Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
