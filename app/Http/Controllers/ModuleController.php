<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Gls;
use Illuminate\Support\Facades\DB;
use Validator;

class ModuleController extends Controller
{
    public function store(Request $request){
        try{
            $validator =  Validator::make($request->all(),[
            'title' => 'required',
            'gls_id'=> 'required', 
            
           
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            } 
    
            DB::beginTransaction();
        
            $module = new Module;
            $module->gls_id=$request->gls_id; 
            $module->title=$request->title;
            $module->save();
            DB::commit();
            return response()->json(['status'=>200,'message'=>'Module Created Successfully']);
    
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
				$module = Module::select("modules.*", "gls.name")->leftjoin('gls','gls.id','=','modules.gls_id')->where('name', 'like', '%'.$filter.'%')->where('modules.is_deleted', '0')->paginate(10);
			} else {
				$module = Module::select("modules.*", "gls.name")->leftjoin('gls','gls.id','=','modules.gls_id')->where('modules.is_deleted', '0')->paginate(10);
			}
			$gls = Gls::where('is_deleted', '0')->get();
            return response()->json(array(
                'status' => 'success',
                'gls' => $gls,
                'pages' => $module),
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
			$Module = Module::where('is_deleted', '0')->where('gls_id', $id)->get(); 
			return response()->json(array(
				'status' => 'success',
				'data' => $Module
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
            $module=Module::find($id);
            if( $module){
                $module->subject_id=$request->subject_id;
                $module->level_id=$request->level_id;
                $module->title=$request->title;
                $module->update();  
           
                return response()->json(['status'=>200,'message'=>'Module Updated Successfully']);
            }else{
                return response()->json(['status'=>404,'message'=>'Module not Found']);
            }
            
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
                 
         
    }

    public function destroy($id) {
        try{
        $module = DB::table('modules')
              ->where('id', $id)
              ->update(['is_deleted' => 1]);
        return $module;
        return response($module)->json(['status'=>200,'message'=>'module Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
