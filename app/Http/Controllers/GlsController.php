<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gls;
use Illuminate\Support\Facades\DB;
use Validator;

class GlsController extends Controller
{
    public function store(Request $request){
        try{
            $validator =  Validator::make($request->all(),[
            'name' => 'required', 
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            } 
    
            DB::beginTransaction();
        
            $gls = new Gls; 
            $gls->name=$request->name;
            $gls->save();
            DB::commit();
            return response()->json(['status'=>200,'message'=>'Gls Created Successfully']);
    
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
				$gls = Gls::where('name', 'like', '%'.$filter.'%')->where('is_deleted', '0')->paginate(10);
			} else {
				$gls = Gls::where('is_deleted', '0')->paginate(10);
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $gls
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
            $gls=Gls::find($id);
            if( $gls){ 
                $gls->name=$request->name;
                $gls->update();  
           
                return response()->json(['status'=>200,'message'=>'Gls Updated Successfully']);
            }else{
                return response()->json(['status'=>404,'message'=>'Gls not Found']);
            }
            
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
                 
         
    }

    public function destroy($id) {

        try{
        $gls = DB::table('gls')
              ->where('id', $id)
              ->update(['is_deleted' => 1]); 
        return response()->json(['status'=>200,'message'=>'Gls Deleted Successfully']);
   
    }catch(\Exception $e){
           DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }
        
}
