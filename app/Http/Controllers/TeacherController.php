<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Agents;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\GeneralController; 
use App\Models\Gls;
use App\Models\Module;
class TeacherController extends Controller
{
	public function __construct()
    {
      $this->generalController = new GeneralController; 
    }
	public function teacher_gl_permission(Request $request, $id){
		$user_id = $id;
		$gls_id = $request->gls_id; 
		$old_gls =DB::table('teacher_gl_permissions')->where('gls_id',$gls_id)->where('user_id',$user_id)->first();
		DB::table('teacher_gl_permissions')->where('user_id',$user_id)->update(['is_active'=>0,'module'=>'']);
		if($old_gls){
			DB::table('teacher_gl_permissions')->where('gls_id',$gls_id)->where('user_id',$user_id)->update(['is_active'=>1]);
		}else{
			DB::table('teacher_gl_permissions')->insert(['user_id'=>$user_id,'is_active'=>1,'gls_id'=>$gls_id]);
		}
		$modules = $request->modules;  
		foreach($modules as $module){
			if($module){
				$module_a = explode("|",$module); 
				$mid = $module_a[0];
				$gid = $module_a[1];
				$gls =DB::table('teacher_gl_permissions')->where('gls_id',$gid)->where('user_id',$user_id)->first();
				if($gls){
					$all_module = explode(',',$gls->module);
					$all_module[] = $mid;
					$add_module = implode(",",$all_module);
					DB::table('teacher_gl_permissions')->where('user_id',$user_id)->where('gls_id',$gid)->where('user_id',$user_id)->update(['module'=>ltrim($add_module,',')]);
				}else{
					$all_module[] = $mid;
					$add_module = implode(",",$all_module);
					DB::table('teacher_gl_permissions')->insert(['user_id'=>$user_id,'is_active'=>0,'gls_id'=>$gid,'module'=>ltrim($add_module,',') ]);
				}
			}
		}
		 
		 
		 return response()->json(['status'=>200,'data'=>[],'message'=>'Level Get Successfully']);
	 
	}
	public function get_gls(Request $request, $id){
		$gls = Gls::select('id','name')->where('is_deleted', '0')->get();
		$activ_gls = '';
		$activ_gls =DB::table('teacher_gl_permissions')->where('is_active',1)->where('user_id',$id)->first();
		if($activ_gls){
			$activ_gls = $activ_gls->gls_id;
		}
		$module_active = array();
		foreach($gls as $gl){
			if($gl){
			$item = array();
			$s = array();
			$module_actives = array();
			$items = array();
			$item['Global_Level'] = $gl;
			 $modules = Module::select('id','title','gls_id')->where('gls_id', $gl->id)->get();
			  foreach($modules as $module){
				$activ_module =DB::table('teacher_gl_permissions')->where('gls_id',$gl->id)->where('user_id',$id)->first();
				if($activ_module){
					$module_ids = explode(',',$activ_module->module); 
					foreach($module_ids as $module_id){
					//$key = array_search($module->id, $module_id);
					
					if ($module_id ==$module->id ) {
						$module_active[] =  $module->id.'|'.$module->gls_id;
					} 
				} 
				} 
				$item[$module->title] = $module; 
			  } 
			$items[]=$item;
			$items_all[] = $items;			
		}
		}
		 return response()->json(['status'=>200,'data'=>$items_all,'active'=>$activ_gls,'module_active'=>$module_active,'message'=>'Level Get Successfully']);
	 
	}
	public function get_teacher_gls(Request $request){
		$activ_gls = '';
		$id = $request->user('sanctum')->id;;
		$activ_gls =DB::table('teacher_gl_permissions')->where('is_active',1)->where('user_id',$id)->first();
		if($activ_gls){
			$activ_gls = $activ_gls->gls_id;
			$gl = Gls::select('id','name')->where('id', $activ_gls)->where('is_deleted', '0')->first();
		}
		
		$modules = Module::select('id','title','gls_id')->where('gls_id', $gl->id)->get();
		foreach($modules as $module){
			$activ_module =DB::table('teacher_gl_permissions')->where('gls_id',$gl->id)->where('user_id',$id)->first();
			if($activ_module){
				$module_ids = explode(',',$activ_module->module); 
				foreach($module_ids as $module_id){			
					if ($module_id ==$module->id ) {
						$module_active[] = $module;
					} 
				} 
			}  
		} 
		$data['module_active'] = $module_active;
		$data['gls'] = $gl;
		return response()->json(['status'=>200,'data'=>$data,'message'=>'Level Get Successfully']);
	 
	}
    public function store(Request $request){
        try{
			$validator =  Validator::make($request->all(),[
            'country'=> 'required',
            'designation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
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
        $teacher = Teacher::updateOrCreate(
            ['user_id' =>$user_id],
            ['country' => $request->country, 'designation' => $request->designation,'first_name'=>$request->first_name,'last_name'=>$request->last_name,'gender'=>$request->gender,'date_of_birth'=>$request->date_of_birth,'phone_number'=>$request->phone_number]
        );
        $teacher->save();
		$log_data['type']='event'; 
		$log_data['user_id']=$user_id; 
		$log_data['action_id']=$teacher->id; 
		$log_data['message']=$request->first_name." ".$request->last_name." added successfully";  
		$this->generalController->logs($log_data);
            DB::commit();
            return response()->json(['status'=>200,'message'=>'Teacher Created Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
        
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
        $Agents = Agents::updateOrCreate(
            ['user_id' =>$user_id],
            ['country' => $request->country, 'full_name' => $request->full_name,'agent_code' => uniqid(),'ic_number'=>$request->ic_number,'phone_number'=>$request->phone_number,'date_of_birth'=>$request->date_of_birth]
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


    public function update(Request $request, $id)
    {
         try{
			$validator =  Validator::make($request->all(),[
            'country'=> 'required',
            'designation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
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
        $teacher = Teacher::updateOrCreate(
            ['id' =>$id],
            ['country' => $request->country, 'designation' => $request->designation,'first_name'=>$request->first_name,'last_name'=>$request->last_name,
			'gender'=>$request->gender,'date_of_birth'=>$request->date_of_birth,
			'phone_number'=>$request->phone_number,
			'teacher_type'=>$request->teacher_type,
			'education_level'=>$request->education_level,
			'address'=>$request->address,
			'ic_no'=>$request->ic_no, 
			]
        );
        $teacher->save();
            DB::commit();
            return response()->json(['status'=>200,'message'=>'Teacher Created Successfully']);
   
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
				->leftjoin('teachers','users.id','=','teachers.user_id')
				->where('users.role',2)->where('teachers.first_name', 'like', '%'.$filter.'%')->orWhere('teachers.last_name', 'like', '%'.$filter.'%')
				->paginate(10);
			} else {
			$teacher =DB::table('users') 
			->where('users.role',2)
			->leftjoin('teachers','users.id','=','teachers.user_id')
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
    public function view($id)
    {
        try{
           $teacher =DB::table('users') 
			->where('users.role',2)
			->where('teachers.id',$id)
			->leftjoin('teachers','users.id','=','teachers.user_id')
			->get()->first();
            return response()->json(array(
                'status' => 'success',
                'data' => $teacher),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
     }
}
