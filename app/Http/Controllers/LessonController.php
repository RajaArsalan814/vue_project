<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Validator;

class LessonController extends Controller
{
    public function store(Request $request){
        try{
            $validator =  Validator::make($request->all(),[
            'title' => 'required', 
            'module_id'=> 'required',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            } 
    
            DB::beginTransaction();
			if($request->id){
			   $lesson=Lesson::find($request->id);
                $lesson->module_id=$request->module_id; 
                $lesson->title=$request->title;
                //$lesson->component=$request->component;
                $lesson->update();  
			}else{
				
				$lesson = new Lesson;
				$lesson->module_id=$request->module_id; 
				$lesson->title=$request->title;
				//$lesson->component=$request->component;
				$lesson->save();
			}
			
            DB::commit();
            return response()->json(['status'=>200,'message'=>'Lesson Created Successfully']);
    
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
				$lesson = Lesson::select("lessons.*", "modules.title as name")
				->leftjoin('modules','modules.id','=','lessons.module_id')
				->where('lessons.title', 'like', '%'.$filter.'%')
				->where('lessons.is_deleted', '0')->paginate(10);
			} else {
				$lesson = Lesson::select("lessons.*", "modules.title as name")
				->leftjoin('modules','modules.id','=','lessons.module_id')
				->where('lessons.is_deleted', '0')->paginate(10);
			}
			$module = Module::where('is_deleted', '0')->get(); 
            return response()->json(array(
                'status' => 'success',
                'module' => $module,
                'pages' => $lesson),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
     }

    public function search($id)
    {
        try{ 
			$Lesson = Lesson::where('is_deleted', '0')->where('module_id', $id)->get(); 
            return response()->json(array(
                'status' => 'success',
                'data' => $Lesson
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
             $lesson=Lesson::find($id);
             if($lesson){ 
                $lesson->module_id=$request->module_id; 
                $lesson->title=$request->title;
                $lesson->component=$request->component;
                $lesson->update();  
            
                 return response()->json(['status'=>200,'message'=>'Lesson Updated Successfully']);
             }else{
                 return response()->json(['status'=>404,'message'=>'Lesson not Found']);
             }
             
         }catch(\Exception $e){
             DB::rollback();	
             return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
         }
                  
          
     }

     public function destroy($id) {
        try{
        $lesson = DB::table('lessons')
              ->where('id', $id)
              ->update(['is_deleted' => 1]);
        return $lesson;
        return response($lesson)->json(['status'=>200,'message'=>'lesson Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
}
