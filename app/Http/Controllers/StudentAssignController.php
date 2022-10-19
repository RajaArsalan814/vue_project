<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student_assign_modules;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\GeneralController; 
class StudentAssignController extends Controller
{
	public function __construct()
    {
      $this->generalController = new GeneralController; 
    }
    public function store(Request $request){
        try{  
			$username = User::where('id',$request->user_id)->first();
			if($request->id){  
				$etoken=Student_assign_modules::find($request->id); 
               
				$etoken->module_id=$request->module_id;
                $etoken->gls_id=$request->gls_id;
                $etoken->user_id=$request->user_id; 
				
                $etoken->update();   
				return response()->json(['status'=>200,'message'=>'Module Assign Update Successfully']);
			}else{
				DB::beginTransaction();
				$etoken = new Student_assign_modules; 
				$etoken->module_id=$request->module_id;
                $etoken->gls_id=$request->gls_id;
                $etoken->user_id=$request->user_id; 
				$etoken->save();
				DB::commit(); 
				return response()->json(['status'=>200,'message'=>'Module Assign Created Successfully']);
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
				$etoken = Student_assign_modules::select("student_assign_modules.*", "modules.title as module_name","gls.name as gls_name") 
				->leftjoin('modules','modules.id','=','student_assign_modules.module_id')
				->leftjoin('gls','gls.id','=','student_assign_modules.gls_id') 
				->where('modules.title', 'like', '%'.$filter.'%')
				->where('student_assign_modules.user_id',$id)
				->paginate(10);
			} else { 
				$etoken = Student_assign_modules::select("student_assign_modules.*","modules.title as module_name","gls.name as gls_name") 
				->leftjoin('modules','modules.id','=','student_assign_modules.module_id')
				->leftjoin('gls','gls.id','=','student_assign_modules.gls_id') 
				->where('student_assign_modules.user_id',$id)
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

    public function destroy($id) {

        try{
        $etoken = DB::table('student_assign_modules')->where('id', $id)->delete(); 
        return response()->json(['status'=>200,'message'=>'Module Assign Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
