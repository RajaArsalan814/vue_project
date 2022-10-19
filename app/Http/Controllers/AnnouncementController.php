<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Validator;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        try
        {
            $validator =  Validator::make($request->all(),[
                'title'=>'required|min:4|unique:announcements,title',
                'announcement_date' => 'required|string',
                'announcement_time'=>'required|string',
                'announcement_type'=>'required|string',            
            ]);
  
            if($validator->fails())
                {
                    return response()->json([
                        "error" => 'validation_error',
                        "message" => $validator->errors(),
                    ], 422);
                }
  
            $announcement_api = new Announcement([
            'title'  => $request->title,
            'announced_audience'  => json_encode($request->announced_audience),
            'description'  => $request->description,
            'announcement_date'  => $request->announcement_date,
            'announcement_time' => $request->announcement_time,
            'announcement_type'=>$request->announcement_type, 
            ]);
        
         
        if($announcement_api->save())
        { 
             DB::commit();
            return response()->json(['message'=>'Announcement Created Successfully!'],200);
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
		Announcement::destroy($id);
		return response()->json(['message'=>'Announcement Deleted Successfully!'],200);
	}
    public function list(Request $request)
    {
         try
           { 
		   
			$user_id = $request->user('sanctum')->id;
            $announcement_api = Announcement::all();
            $date = DB::table('announcements')->select('*')->orWhere('user_id',0)->orWhere('user_id',$user_id)->orderBy('id', 'DESC')->get();
    
            foreach ($date as $formats)
            {
               $format = $formats->announcement_date;
               $formats->date = date('l:F:Y', strtotime($format));
               $formats->day=date(' l', strtotime($format));
               $formats->month=date('F', strtotime($format));
               $formats->day_digit=date('D', strtotime($format));
               $formats->year=date('Y', strtotime($format));
			  $all_data[] = $formats;
            }
          
            return response()->json(array(
                'status' => 'success',
                'data' => $all_data),
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
			$announcement_api = Announcement::where('title', 'like', '%'.$filter.'%')
			->paginate(10);
			} else {
			$announcement_api = Announcement::paginate(10);

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
