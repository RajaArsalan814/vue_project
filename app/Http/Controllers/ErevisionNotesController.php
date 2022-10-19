<?php

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Models\Gls;
use App\Models\Erevision_notes;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Classroom_activity;
use App\Models\Eprep_activity;

class ErevisionNotesController extends Controller
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
				$component=Erevision_notes::find($request->id);
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
				$component->title=$request->title;
				$component->e_revision_id=$request->e_revision_id;
				$component->gls_id=$request->gls_id;
				$component->module_id=$request->module_id;
				$component->lesson_id=$request->lesson_id;
				if($request->visibility){
					$component->visibility=$request->visibility;
				}
				
				if($request->components){
					$component->components=$request->components;
				}
				
                $component->update();  
                return response()->json(['status'=>200,'message'=>'Notes Updated Successfully']);
            }else{
				$component = new Erevision_notes; 
				 
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
			  if($request->url){
				$data = $request->url;
				list($type, $data) = explode(';', $data); 
				list(, $data)      = explode(',', $data);
				$data = base64_decode($data);
				$file_type = explode('/', $type)[1];
				$name = $request->type.uniqid().".".$file_type;
				$image = public_path().'/pdf/'.$name;
				file_put_contents($image, $data);
				$component->url='public/pdf/'.$name;
			  }
				
				$component->title=$request->title;
				$component->e_revision_id=$request->e_revision_id;
				$component->gls_id=$request->gls_id;
				$component->module_id=$request->module_id;
				$component->lesson_id=$request->lesson_id;
				if($request->visibility){
					$component->visibility=$request->visibility;
				}
				if($request->components){
					$component->components=$request->components;
				}
				$component->save();
			} 
            return response()->json(['status'=>200,'message'=>'Notes Created Successfully']);
    
         }catch(\Exception $e){
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        } 
        
    }
    
    
    public function show(Request $request,$id)
    {
        try{ 
			$filter = $request->query('q');
			if (!empty($filter)) { 
				
				$component = Erevision_notes::select("erevision_notes.*", "modules.title as module", "lessons.title as lesson", "gls.name as level")
				->leftjoin('modules','modules.id','=','erevision_notes.module_id')
				->leftjoin('lessons','lessons.id','=','erevision_notes.lesson_id')
				->leftjoin('gls','gls.id','=','erevision_notes.gls_id')
				->where('name', 'like', '%'.$filter.'%')
				->where('erevision_notes.e_revision_id',$id)
				->paginate(10);
			} else {
				$component = Erevision_notes::select("erevision_notes.*", "modules.title as module", "lessons.title as lesson", "gls.name as level")
				->leftjoin('modules','modules.id','=','erevision_notes.module_id')
				->leftjoin('lessons','lessons.id','=','erevision_notes.lesson_id')
				->leftjoin('gls','gls.id','=','erevision_notes.gls_id')
				->where('erevision_notes.e_revision_id',$id)
				->paginate(10);
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
    public function list_all(Request $request)
    {
        try{ 
			$component = Erevision_notes::select("erevision_notes.*", "modules.title as module", "lessons.title as lesson", "gls.name as level")
			->leftjoin('modules','modules.id','=','erevision_notes.module_id')
			->leftjoin('lessons','lessons.id','=','erevision_notes.lesson_id')
			->leftjoin('gls','gls.id','=','erevision_notes.gls_id') 
			->get(100);
			$activity = array();
			 
			$activity = Classroom_activity::get(); 

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
			$gls = Erevision_notes::where('is_deleted', '0')->get(); 
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

    public function destroy($id) {

        try{
		Erevision_notes::destroy($id);
        return response()->json(['status'=>200,'message'=>'Gls Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
