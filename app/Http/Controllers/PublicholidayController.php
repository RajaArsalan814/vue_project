<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Public_holiday;
use Illuminate\Support\Facades\DB;
use Validator;

class PublicholidayController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $validator =  Validator::make($request->all(),[
                'title'=>'required|min:4|unique:announcements,title',
                'description' => 'required|string',
                'date'=>'required|string',      
            ]);
  
            if($validator->fails())
                {
                    return response()->json([
                        "error" => 'validation_error',
                        "message" => $validator->errors(),
                    ], 422);
                }
  
            $announcement_api = new Public_holiday([
            'title'  => $request->title,
            'date'  => $request->date,
            'description' => $request->description, 
            ]);
        
         
        if($announcement_api->save())
        { 
             DB::commit();
            return response()->json(['message'=>'Public holiday Created Successfully!'],200);
        }else  
        {
         return response()->json(['status'=>400,$request->validator->fails()]);
        }

        } catch(\Exception $e)
        {
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
         }
         
    }
	
    public function delete($id){
		Public_holiday::destroy($id);
		return response()->json(['message'=>'Public holiday Deleted Successfully!'],200);
	}
    public function list()
    {
         try
           { 
            $announcement_api = Public_holiday::all();
            $date = DB::table('public_holidays')->select('*')->get();
    
            
          
            return response()->json(array(
                'status' => 'success',
                'data' => $date),
                200
            );
           }
           catch(\Exception $e)
           {
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
           } 
    }
    public function holiday()
    {
         try
           { 
            $announcement_api = Public_holiday::all();
            $date = DB::table('public_holidays')->select('date')->get();          
			foreach($date as $d){
				$dates[]=$d->date;
			}
			$f_dates = DB::table('public_holidays')->whereDate('date','>',date('Y-m-d'))->select('date')->get();          
			foreach($f_dates as $d){
				$f_datess[]= date('jS F', strtotime($d->date)).' - Holiday';
			}
            return response()->json(array(
                'status' => 'success',
                'data' => $dates,
                'f_dates' => $f_datess,
				),
                200
            );
           }
           catch(\Exception $e)
           {
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
           } 
    }
    public function list_admin(Request $request)
    {
         try
           { 
		    $filter = $request->query('q');
			if (!empty($filter)) {
			$announcement_api = Public_holiday::where('title', 'like', '%'.$filter.'%')
			->paginate(10);
			} else {
			$announcement_api = Public_holiday::paginate(10);

			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $announcement_api
			),
                200
            );
           }
           catch(\Exception $e)
           {
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
           } 
    }
     

}
