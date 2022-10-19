<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\Module;
use App\Models\Gls;
use Illuminate\Support\Facades\DB;
use Validator;

class StudentController extends Controller
{
	public function get_student_gls(Request $request){
		$id = $request->user('sanctum')->id;
		$data=array();
		$students =DB::table('students')->where('parent_id',$id)->first(); 
		$student_assign_modules =DB::table('student_assign_modules')->where('user_id',$students->user_id)->first(); 
		if($student_assign_modules){
			$gl = Gls::select('id','name')->where('id', $student_assign_modules->gls_id)->where('is_deleted', '0')->first();
			$modules = Module::select('id','title')->where('id', $student_assign_modules->module_id)->first();
			$data['modules'] = $modules;
			$teachers =DB::table('teacher_gl_permissions')->select("teacher_gl_permissions.*" ,"teachers.user_id as teacher_id","teachers.first_name", "teachers.last_name")
			->leftjoin('teachers','teachers.user_id','=','teacher_gl_permissions.user_id')
			->where('teacher_gl_permissions.gls_id',$student_assign_modules->gls_id)
			->where('teacher_gl_permissions.module', 'like', '%'.$student_assign_modules->module_id.'%')->get();
			$data['teachers'] = $teachers;
			$data['gls'] = $gl;
		}
		return response()->json(['status'=>200,'data'=>$data,'message'=>'Level Get Successfully']);
	 
	}
	public function get_student_gls_check(Request $request){
		$user_id = $request->user('sanctum')->id;
	 
		$student_assign_modules =DB::table('student_assign_modules')->where('user_id',$user_id)->first(); 
		if($student_assign_modules){
			$gl = Gls::select('id','name')->where('id', $student_assign_modules->gls_id)->where('is_deleted', '0')->first();
			$modules = Module::select('id','title')->where('id', $student_assign_modules->module_id)->first();
			$data['modules'] = $modules;
			$teachers =DB::table('teacher_gl_permissions')->select("teacher_gl_permissions.*" ,"teachers.user_id as teacher_id","teachers.first_name", "teachers.last_name")
			->leftjoin('teachers','teachers.user_id','=','teacher_gl_permissions.user_id')
			->where('teacher_gl_permissions.gls_id',$student_assign_modules->gls_id)
			->where('teacher_gl_permissions.module', 'like', '%'.$student_assign_modules->module_id.'%')->get();
			$data['teachers'] = $teachers;
			$data['gls'] = $gl;
		}
		return response()->json(['status'=>200,'data'=>$data,'message'=>'Level Get Successfully']);
	 
	}
    public function student(Request $request)
    {
		try
        {  
           // dd($user_id);
		$user = DB::table('users')->where('role',2)->get();
         if(isset($user)){
            $validator =  Validator::make($request->all(),[
                   'name'=>'required|min:4|unique:students,student_name',
                    'gender'=>'required|string',
                    'date_of_birth'=>'required',
                    'current_school'=>'required|string',
                
                ]);

                if($validator->fails()){
                    return response()->json([
                        "error" => 'validation_error',
                        "message" => $validator->errors(),
                    ], 422);
                }
                
            DB::beginTransaction();
            $user = new User([
                'name'  => $request->name,
                'username'  => $request->username,
                'email' => $request->email,
                'role'=>$request->role,
                'password' => bcrypt($request->password), 
            ]);
      
        if($user->save()){
              
               $student = new Student(
                ['user_id' =>$user->id,
                'student_name' => $user->name,
                'parent_id' =>$request->user('sanctum')->id,
                'gender' => $request->gender,
                'date_of_birth'=>$request->date_of_birth,
                'current_school'=>$request->current_school,
                'student_phone_number'=>$request->student_phone_number,
                ]
                );
         }}else
         {
            return response()->json(['status'=>400,'message'=>'only parents can create student .']);
         }

                if($student->save())
                {
                    DB::commit();
                    return response()->json(['message'=>'Student Created Successfully!'],200);
                }else  
                {
                return response()->json(['status'=>400,$request->validator->fails()]);
                }
                           
       
        }catch(\Exception $e){
           DB::rollback();	
           return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
        
    }
    public function show(Request $request)
    {
     try{
	//	$student = Student::all();;
		$filter = $request->query('q');
		if (!empty($filter)) {
			$student =DB::table('users') 
			->leftjoin('students','users.id','=','students.user_id')
			->where('users.role',4)->where('students.student_name', 'like', '%'.$filter.'%')
			->paginate(10);
		} else {
			$student =DB::table('users') 
			->leftjoin('students','users.id','=','students.user_id')
			->where('users.role',4)
			->paginate(10);
		}
         return response()->json(array(
             'status' => 'success',
             'pages' => $student->toArray()),
             200
         );
     }catch(\Exception $e){
         DB::rollback();	
         return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
     }
  
    }
}