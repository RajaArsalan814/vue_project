<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Gls;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Classroom_activity;
use App\Models\Eprep_activity;
use App\Models\Erevision_notes;

class ComponentController extends Controller
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
				$component=Component::find($request->id);
				if($request->image){
					$data = $request->image; 
					if(isset(explode(';', $data)[1])){
						list($type, $data) = explode(';', $data);
						$file_type = explode('/', $request->file_type)[1];
						list(, $data)      = explode(',', $data);
						$data = base64_decode($data);
						$name = $request->type.uniqid().".".$file_type;
						$image = public_path().'/component/'.$name;
						file_put_contents($image, $data);
						$component->image='public/component/'.$name;
					}
				}
				if($request->type == 'lesson' OR $request->type == 'answer'){
					$data = $request->url;
					if(isset(explode(';', $data)[1])){
						list($type, $data) = explode(';', $data); 
						list(, $data)      = explode(',', $data);
						$data = base64_decode($data);
						$file_type = explode('/', $type)[1];
						$name = $request->type.uniqid().".".$file_type;
						$image = public_path().'/pdf/'.$name;
						file_put_contents($image, $data);
						$component->url='public/pdf/'.$name;
					}
				}else{
					$component->url=$request->url;
				}
				$component->type=$request->type;
				$component->title=$request->title;
				$component->gls_id=$request->gls_id;
				$component->module_id=$request->module_id;
				$component->lesson_id=$request->lesson_id;
				if($request->visibility){
					$component->visibility=$request->visibility;
				}
				if($request->questionnaire){
					$component->questionnaire=$request->questionnaire;
				}
				
				if($request->components){
					$component->components=$request->components;
				}
				
                $component->update();  
                return response()->json(['status'=>200,'message'=>'Component Updated Successfully']);
            }else{
				$component = new Component; 
				 
				if($request->image){
					$data = $request->image;
					list($type, $data) = explode(';', $data);
					$file_type = explode('/', $type)[1];
					list(, $data)      = explode(',', $data);
					$data = base64_decode($data);
					$name = $request->type.uniqid().".".$file_type;
					$image = public_path().'/component/'.$name;
					file_put_contents($image, $data);
					$component->image='public/component/'.$name;
				}
				
				if($request->type == 'lesson' OR $request->type == 'answer'){
					$data = $request->url;
					list($type, $data) = explode(';', $data); 
					list(, $data)      = explode(',', $data);
					$data = base64_decode($data);
					$file_type = explode('/', $type)[1];
					$name = $request->type.uniqid().".".$file_type;
					$image = public_path().'/pdf/'.$name;
					file_put_contents($image, $data);
					$component->url='public/pdf/'.$name;
				}else{
					$component->url=$request->url;
				}
				
				if($request->questionnaire){
					$component->questionnaire=$request->questionnaire;
				}
				$component->type=$request->type;
				$component->title=$request->title;
				$component->gls_id=$request->gls_id;
				$component->module_id=$request->module_id;
				$component->lesson_id=$request->lesson_id;
				if($request->visibility){
					$component->visibility=$request->visibility;
				}
				if($request->components){
					$component->components=$request->components;
				}
				if($request->components){
					$component->components=$request->components;
				}
				$component->save();
			} 
            return response()->json(['status'=>200,'message'=>'Component Created Successfully']);
    
         }catch(\Exception $e){
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        } 
        
    }
    
    
    public function show(Request $request,$type)
    {
        try{ 
			$filter = $request->query('q');
			if($type=="classroom"){
				
				if (!empty($filter)) { 
					$component = Component::select("components.*", "modules.title as module", "lessons.title as lesson", "gls.name as level",DB::raw('count(classroom_activitys.classroom_id) as `ct_activity`'))
					->leftjoin('modules','modules.id','=','components.module_id')
					->leftjoin('lessons','lessons.id','=','components.lesson_id')
					->leftjoin('classroom_activitys','classroom_activitys.classroom_id','=','components.id')
					->leftjoin('gls','gls.id','=','components.gls_id')
					->where('components.type',$type)
					->where('name', 'like', '%'.$filter.'%')
					->where('components', 'like', '%'.$filter.'%')
					->paginate(10);
				} else {
					$component = Component::select("components.*", "modules.title as module", "lessons.title as lesson", "gls.name as level",DB::raw('count(classroom_activitys.classroom_id) as `ct_activity`'))
					->leftjoin('modules','modules.id','=','components.module_id')
					->leftjoin('lessons','lessons.id','=','components.lesson_id')
					->leftjoin('classroom_activitys','classroom_activitys.classroom_id','=','components.id')
					->leftjoin('gls','gls.id','=','components.gls_id')
					->where('components.type',$type)
					  ->groupBy('classroom_activitys.classroom_id')
					->paginate(10);
				}
			}else{
				if (!empty($filter)) { 
					$component = Component::select("components.*", "modules.title as module", "lessons.title as lesson", "gls.name as level")
					->leftjoin('modules','modules.id','=','components.module_id')
					->leftjoin('lessons','lessons.id','=','components.lesson_id')
					->leftjoin('gls','gls.id','=','components.gls_id')
					->where('components.type',$type)
					->where('name', 'like', '%'.$filter.'%')
					->where('components', 'like', '%'.$filter.'%')
					->paginate(10);
				} else {
					$component = Component::select("components.*", "modules.title as module", "lessons.title as lesson", "gls.name as level")
					->leftjoin('modules','modules.id','=','components.module_id')
					->leftjoin('lessons','lessons.id','=','components.lesson_id')
					->leftjoin('gls','gls.id','=','components.gls_id')
					->where('components.type',$type)
					->paginate(10);
				}
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $component
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
     }
    public function list_all(Request $request,$type)
    {
        try{ 
			$component = Component::select("components.*", "modules.title as module", "lessons.title as lesson", "components.components as component_name", "gls.name as level")
			->leftjoin('modules','modules.id','=','components.module_id')
			->leftjoin('lessons','lessons.id','=','components.lesson_id')
			->leftjoin('gls','gls.id','=','components.gls_id')
			->where('components.type',$type)
			->where('components.visibility',0)
			->get(100);
			$activity = array();
			if( $type == 'classroom'){
				$activity = Classroom_activity::get();
			}
			if( $type == 'eprep'){
				$activity = Eprep_activity::get();
			}
			if( $type == 'revision'){
				$activity = Erevision_notes::get();
			}
            return response()->json(array(
                'status' => 'success',
                'activity' => $activity,
                'pages' => $component
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
			$gls = Gls::where('is_deleted', '0')->get(); 
            return response()->json(array(
                'status' => 'success',
                'data' => $gls
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
            $component=Component::find($id);
            if( $component){ 
				DB::beginTransaction(); 
				if($request->image){
					$data = $request->image;
					list($type, $data) = explode(';', $data);
					$file_type = explode('/', $request->file_type)[1];
					list(, $data)      = explode(',', $data);
					$data = base64_decode($data);
					$name = $component->type.uniqid().".".$file_type;
					$image = public_path().'/component/'.$name;
					file_put_contents($image, $data);
					$component->image='public/component/'.$name;
				}
				$component->title=$request->title;
				$component->gls_id=$request->gls_id;
				$component->module_id=$request->module_id;
				$component->lesson_id=$request->lesson_id;
				$component->url=$request->url;
				if($request->visibility){
					$component->visibility=$request->visibility;
				}
                $component->update();  
           
                return response()->json(['status'=>200,'message'=>'Component Updated Successfully']);
            }else{
                return response()->json(['status'=>404,'message'=>'Component not Found']);
            }
            
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
                 
         
    }

    public function destroy($id) {

        try{
		Component::destroy($id);
        return response()->json(['status'=>200,'message'=>'Gls Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
