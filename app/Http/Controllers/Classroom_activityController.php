<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classroom_activity;
use Illuminate\Support\Facades\DB;
use Validator;

class Classroom_activityController extends Controller
{
    public function store(Request $request){
        try{
            $validator =  Validator::make($request->all(),[
            'title' => 'required', 
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            } 
			if($request->id){ 
				$activity=Classroom_activity::find($request->id); 
                $activity->url=$request->url;
                $activity->title=$request->title;
                $activity->type=$request->type;
                $activity->classroom_id=$request->classroom_id;
                $activity->update();  
				return response()->json(['status'=>200,'message'=>'Activity Update Successfully']);
			}else{
				DB::beginTransaction();
				$activity = new Classroom_activity; 
				$activity->title=$request->title;
				$activity->url=$request->url;
				$activity->type=$request->type;
				$activity->classroom_id=$request->classroom_id;
				$activity->save();
				DB::commit();
				return response()->json(['status'=>200,'message'=>'Activity Created Successfully']);
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
				$activity = Classroom_activity::where('classroom_id', $id)->where('title', 'like', '%'.$filter.'%')->paginate(10);
			} else {
				$activity = Classroom_activity::where('classroom_id', $id)->paginate(10);
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $activity
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
			$activity = Classroom_activity::get(); 
            return response()->json(array(
                'status' => 'success',
                'data' => $activity
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
            $activity=Classroom_activity::find($id);
            if( $activity){ 
                $activity->url=$request->url;
                $activity->title=$request->title;
                $activity->type=$request->type;
                $activity->classroom_id=$request->classroom_id;
                $activity->update();  
           
                return response()->json(['status'=>200,'message'=>'Activity Updated Successfully']);
            }else{
                return response()->json(['status'=>404,'message'=>'Activity not Found']);
            }
            
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
                 
         
    }

    public function destroy($id) {

        try{
        $activity = DB::table('classroom_activitys')->where('id', $id)->delete(); 
        return response()->json(['status'=>200,'message'=>'Activity Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
