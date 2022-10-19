<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\Agents;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\GeneralController; 
use App\Models\Gls;
use App\Models\Module;
class AgentController extends Controller
{
	public function __construct()
    {
      $this->generalController = new GeneralController; 
    }
	  

    public function agent_add(Request $request){
        try{
			$validator =  Validator::make($request->all(),[  
            'full_name' => 'required', 
            'phone_number' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 422);
        } 

        DB::beginTransaction();
        $user_id =$request->user('sanctum')->id;
		$agents_image= '';
		if($request->image){
			$data = $request->image; 
			if(isset(explode(';', $data)[1])){
				list($type, $data) = explode(';', $data);
				$file_type = explode('/', $request->file_type)[1];
				list(, $data)      = explode(',', $data);
				$data = base64_decode($data);
				$name = $request->type.uniqid().".".$file_type;
				$image = public_path().'/agents/'.$name;
				file_put_contents($image, $data);
				$agents_image='public/agents/'.$name;
			}
		}
		$agent_array = array('country' => $request->country, 'full_name' => $request->full_name,'agent_code' => uniqid(),'ic_number'=>$request->ic_number,'phone_number'=>$request->phone_number,'date_of_birth'=>$request->date_of_birth);
		if($agents_image){
			$agent_array->ic_picture = $agents_image;
		}
        $Agents = Agents::updateOrCreate(
            ['user_id' =>$user_id],$agent_array
        );
        $Agents->save();
		$log_data['type']='event'; 
		$log_data['user_id']=$user_id; 
		$log_data['action_id']=$Agents->id; 
		$log_data['message']=$request->full_name." added successfully";  
		$this->generalController->logs($log_data);
		DB::commit();
		return response()->json(['status'=>200,'message'=>'Agents Created Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
        
    }
	public function show(Request $request)
    {
        try{
            $filter = $request->query('q');
			if (!empty($filter)) {
				$teacher =DB::table('users') 
				->leftjoin('agents','users.id','=','agents.user_id')
				->where('users.role',2)->where('agents.first_name', 'like', '%'.$filter.'%')->orWhere('agents.last_name', 'like', '%'.$filter.'%')
				->paginate(10);
			} else {
			$teacher =DB::table('users') 
			->where('users.role',2)
			->leftjoin('agents','users.id','=','agents.user_id')
			->paginate(10);
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $teacher->toArray()),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
	}
 
}
