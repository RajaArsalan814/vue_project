<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gls;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Etoken;
use App\Models\User;
use App\Models\Classes;
use App\Models\Announcement;
use App\Models\Student_book_classes;
use App\Models\Eprep_activity;
use App\Http\Controllers\GeneralController;
class ClassesController extends Controller
{
	public function __construct()
    {
      $this->generalController = new GeneralController;
    }
    public function store(Request $request){
         try{
            if($request->id){
				$classes=Classes::find($request->id);
				$classes->class_time=json_encode($request->class_time);
				//$classes->type=$request->type;
				//$classes->gls_id=$request->gls;
				//$classes->class_date=$request->class_date;
				//$classes->day=date('l', strtotime($request->class_date));
                $classes->update();
                return response()->json(['status'=>200,'message'=>'Class Updated Successfully']);
            }else{
				$classes = new Classes;
				$user_id = $request->user('sanctum')->id;
				$classes->class_time=json_encode($request->class_time);
				$classes->class_id=uniqid();
				$classes->type=$request->type;
				$classes->day=date('l', strtotime($request->class_date));
				$classes->user_id=$user_id;
				$classes->gls_id=$request->gls;
				$classes->class_date=$request->class_date;
				$classes->status='pending';
				$classes->save();

				$users = DB::table('users')->where('id',$user_id)->first();
				$get_gls = DB::table('gls')->where('id',$request->gls)->first();
				$log_data['message']= "A new class was opened by @".$users->username.", for ".$get_gls->name;
				$log_data['type']='class';
				$log_data['user_id']=$user_id;
				$log_data['action_id']=$classes->id;
				$this->generalController->logs($log_data);
			}
            return response()->json(['status'=>200,'message'=>'Class Created Successfully']);

         }catch(\Exception $e){
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }

    }
    public function book_class(Request $request){


		try{
			$msg ='';
			$user_id = $request->user('sanctum')->id;
			$total_token = Etoken::where('user_id', $user_id)->sum('token_amount');
			if($total_token < 180){
				  return response()->json(['status'=>400,'message'=>'Insufficient token for book class']);
			}
			$check_class = Student_book_classes::where('user_id',$user_id)->where('class_id',$request->class_id)->first();
			if($check_class && $request->type == 'private'){
				  return response()->json(['status'=>400,'message'=>'You already have an active class']);
			}
            if($request->id){
				$classes=Student_book_classes::find($request->id);
				$classes->class_time=json_encode($request->class_time);
				$classes->type=$request->type;
				$classes->gls_id=$request->gls;
				$classes->class_date=$request->class_date;
				$classes->day=date('l', strtotime($request->class_date));
                $classes->update();
                return response()->json(['status'=>200,'message'=>'Class Booked Successfully']);
            }else{
				$checktime['0'] = '09.00 am - 10.30 am';
				$checktime['1'] = '10.00 am - 11.30 am';
				$checktime['2'] = '11.00 am - 12.30 pm';
				$checktime['3'] = '12.00 pm - 01.30 pm';
				$checktime['4'] = '01.00 pm - 2.30 pm';
				$checktime['5'] = '02.00 pm - 3.30 pm';
				$checktime['6'] = '3.00 pm - 4.30 pm';
				$checktime['7'] = '4.00 pm - 5.30 pm';
				$checktime['8'] = '5.00 pm - 6.30 pm';
				$checktime['9'] = '6.00 pm - 7.30 pm';
				$checktime['10'] = '7.00 pm - 8.30 pm';
				$checktime['11'] = '8.00 pm - 9.30 pm';
				$checktime['12'] = '9.00 pm - 10.30 pm';

				$checktime_key['09.00 am - 10.30 am'] = '0';
				$checktime_key['10.00 am - 11.30 am'] = '1';
				$checktime_key['11.00 am - 12.30 pm'] = '2';
				$checktime_key['12.00 pm - 01.30 pm'] = '3';
				$checktime_key['01.00 pm - 2.30 pm'] = '4';
				$checktime_key['02.00 pm - 3.30 pm'] = '5';
				$checktime_key['3.00 pm - 4.30 pm'] = '6';
				$checktime_key['4.00 pm - 5.30 pm'] = '7';
				$checktime_key['5.00 pm - 6.30 pm'] = '8';
				$checktime_key['6.00 pm - 7.30 pm'] = '9';
				$checktime_key['7.00 pm - 8.30 pm'] = '10';
				$checktime_key['8.00 pm - 9.30 pm'] = '11';
				$checktime_key['9.00 pm - 10.30 pm'] = '12';


				$get_classes = DB::table('classes')->where('id',$request->class_id)->first();

				$class_time =  $request->class_time;

				$r_class_time =json_decode($get_classes->class_time,true);
				$s_nine = false;
				$s_ten = false;
				$s_eleven = false;
				$s_twel = false;
				$s_four = false;
				$s_three = false;
				$s_five = false;
				$s_one = false;
				$s_two = false;
				$s_six = false;
				$s_seven = false;
				$s_eight = false;
				foreach($request->class_time as $class){
					if($class == "09.00 am - 10.30 am"){
						if (($key = array_search('10.00 am - 11.30 am', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_nine = true;
					}else if($class == "10.00 am - 11.30 am" && $s_nine == false){
						if (($key = array_search('09.00 am - 10.30 am', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('11.00 am - 12.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_ten = true;
					}else if($class == "11.00 am - 12.30 pm" && $s_ten == false){
						if (($key = array_search('10.00 am - 11.30 am', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('12.00 pm - 01.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_eleven = true;
					}else if($class == "12.00 pm - 01.30 pm" && $s_eleven == false){
						if (($key = array_search('01.00 pm - 2.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('["11.00 am - 12.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_twel = true;
					}else if($class == "01.00 pm - 2.30 pm" && $s_twel == false){
						if (($key = array_search('02.00 pm - 3.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('12.00 am - 01.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_one = true;
					}else if($class == "02.00 pm - 3.30 pm" && $s_one == false){
						if (($key = array_search('3.00 pm - 4.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('01.00 pm - 2.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_two = true;
					}else if($class == "3.00 pm - 4.30 pm" && $s_two == false){
						if (($key = array_search('4.00 pm - 5.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('02.00 pm - 3.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_three = true;
					}else if($class == "4.00 pm - 5.30 pm" && $s_three == false){
						if (($key = array_search('3.00 pm - 4.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('5.00 pm - 6.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_four = true;
					}else if($class == "5.00 pm - 6.30 pm" && $s_four == false){
						if (($key = array_search('4.00 pm - 5.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('6.00 pm - 7.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_five = true;
					}else if($class == "6.00 pm - 7.30 pm" && $s_five == false){
						if (($key = array_search('5.00 pm - 6.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('7.00 pm - 8.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_six = true;
					}else if($class == "7.00 pm - 8.30 pm" && $s_six == false){
						if (($key = array_search('6.00 pm - 7.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('8.00 pm - 9.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_seven = true;
					}else if($class == "8.00 pm - 9.30 pm" && $s_seven == false){
						if (($key = array_search('7.00 pm - 8.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						if (($key = array_search('9.00 pm - 10.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
						$s_eight = true;
					}else if($class == "9.00 pm - 10.30 pm" && $s_eight == false){
						if (($key = array_search('8.00 pm - 9.30 pm', $class_time)) == true) {
							unset($class_time[$key]);
						}
					}
				//	print_r($class_time);
				/*	if($checktime_key[$class] != '0' ){
						$m = $checktime_key["$class"]-1;
						$p = $checktime_key["$class"]+1;
						$a = $checktime[$m];
						$b = $checktime[$p];
						if($class == $m){
				 		if (($key = array_search($a, $class_time)) == true) {
							unset($class_time[$key]);
							unset($checktime_key["$class"]);
							unset($checktime[$m]);
						}
						if (($key = array_search($b, $class_time)) == true) {
							unset($class_time[$key]);
							unset($checktime_key["$class"]);
							unset($checktime[$m]);
						}
						if (($key = array_search($a, $r_class_time)) == true) {
							unset($r_class_time[$key]);
							unset($checktime_key["$class"]);
							unset($checktime[$m]);
						}
						if (($key = array_search($b, $r_class_time)) == true) {
							unset($r_class_time[$key]);
							unset($checktime_key["$class"]);
							unset($checktime[$m]);
						}
						}
					} */
				}
				$s_nine = false;
				$s_ten = false;
				$s_eleven = false;
				$s_twel = false;
				$s_four = false;
				$s_three = false;
				$s_five = false;
				$s_one = false;
				$s_two = false;
				$s_six = false;
				$s_seven = false;
				$s_eight = false;
				$g_r_class_time = $r_class_time;
				foreach($request->class_time as $class){

					if($class == "09.00 am - 10.30 am"){
						//if (($key = array_search('10.00 am - 11.30 am', $g_r_class_time)) == false) {
						if ((in_array("10.00 am - 11.30 am", $g_r_class_time))) {
							unset($g_r_class_time[$key]);
						}
						$s_nine = true;
					}else if($class == "10.00 am - 11.30 am" && $s_nine == false){
						//if (($key = array_search('09.00 am - 10.30 am', $g_r_class_time)) == true) {
						if ((in_array("09.00 am - 10.30 am", $g_r_class_time))) {
							$key = array_search('09.00 am - 10.30 am', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("11.00 am - 12.30 pm", $g_r_class_time))) {
						//if (($key = array_search('11.00 am - 12.30 pm', $g_r_class_time)) == true) {
							$key = array_search('11.00 am - 12.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_ten = true;
					}else if($class == "11.00 am - 12.30 pm" && $s_ten == false){
						if ((in_array("10.00 am - 11.30 am", $g_r_class_time))) {
						//if (($key = array_search('10.00 am - 11.30 am', $g_r_class_time)) == true) {
							$key = array_search('10.00 am - 11.30 am', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("12.00 pm - 01.30 pm", $g_r_class_time))) {
						//if (($key = array_search('12.00 pm - 01.30 pm', $g_r_class_time)) == true) {
							$key = array_search('12.00 pm - 01.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_eleven = true;
					}else if($class == "12.00 pm - 01.30 pm" && $s_eleven == false){
						if ((in_array("01.00 pm - 2.30 pm", $g_r_class_time))) {
						//if (($key = array_search('01.00 pm - 2.30 pm', $g_r_class_time)) == true) {
							$key = array_search('01.00 pm - 2.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("11.00 am - 12.30 pm", $g_r_class_time))) {
						//if (($key = array_search('["11.00 am - 12.30 pm', $g_r_class_time)) == true) {
							unset($g_r_class_time[$key]);
						}
						$s_twel = true;
					}else if($class == "01.00 pm - 2.30 pm" && $s_twel == false){
						if ((in_array("02.00 pm - 3.30 pm", $g_r_class_time))) {
						// if (($key = array_search('02.00 pm - 3.30 pm', $g_r_class_time)) == true) {
							$key = array_search('02.00 pm - 3.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("12.00 pm - 01.30 pm", $g_r_class_time))) {
						//if (($key = array_search('12.00 pm - 01.30 pm', $g_r_class_time)) == true) {
							$key = array_search('12.00 pm - 01.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_one = true;
					}else if($class == "02.00 pm - 3.30 pm" && $s_one == false){
						if ((in_array("3.00 pm - 4.30 pm", $g_r_class_time))) {
						// if (($key = array_search('3.00 pm - 4.30 pm', $g_r_class_time)) == true) {
							$key = array_search('3.00 pm - 4.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("01.00 pm - 2.30 pm", $g_r_class_time))) {
						//if (($key = array_search('01.00 pm - 2.30 pm', $g_r_class_time)) == true) {
							$key = array_search('01.00 pm - 2.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_two = true;
					}else if($class == "3.00 pm - 4.30 pm" && $s_two == false){
						if ((in_array("4.00 pm - 5.30 pm", $g_r_class_time))) {
						//if (($key = array_search('4.00 pm - 5.30 pm', $g_r_class_time)) == true) {
							$key = array_search('4.00 pm - 5.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("02.00 pm - 3.30 pm", $g_r_class_time))) {
						//if (($key = array_search('02.00 pm - 3.30 pm', $g_r_class_time)) == true) {
							$key = array_search('02.00 pm - 3.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_three = true;
					}else if($class == "4.00 pm - 5.30 pm" && $s_three == false){
						if ((in_array("3.00 pm - 4.30 pm", $g_r_class_time))) {
						//if (($key = array_search('3.00 pm - 4.30 pm', $g_r_class_time)) == true) {
							$key = array_search('3.00 pm - 4.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("5.00 pm - 6.30 pm", $g_r_class_time))) {
						//if (($key = array_search('5.00 pm - 6.30 pm', $g_r_class_time)) == true) {
							$key = array_search('5.00 pm - 6.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_four = true;
					}else if($class == "5.00 pm - 6.30 pm" && $s_four == false){
						if ((in_array("4.00 pm - 5.30 pm", $g_r_class_time))) {
						//if (($key = array_search('4.00 pm - 5.30 pm', $g_r_class_time)) == true) {
							$key = array_search('4.00 pm - 5.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("6.00 pm - 7.30 pm", $g_r_class_time))) {
						//if (($key = array_search('6.00 pm - 7.30', $g_r_class_time)) == true) {
							$key = array_search('6.00 pm - 7.30', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_five = true;
					}else if($class == "6.00 pm - 7.30 pm" && $s_five == true){
						if ((in_array("5.00 pm - 6.30 pm", $g_r_class_time))) {
						//if (($key = array_search('5.00 pm - 6.30 pm', $g_r_class_time)) == true) {
							$key = array_search('5.00 pm - 6.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("7.00 pm - 8.30 pm", $g_r_class_time))) {
						//if (($key = array_search('7.00 pm - 8.30 pm', $g_r_class_time)) == true) {
							$key = array_search('7.00 pm - 8.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_six = true;
					}else if($class == "7.00 pm - 8.30 pm" && $s_six == false){
						if ((in_array("6.00 pm - 7.30 pm", $g_r_class_time))) {
						//if (($key = array_search('6.00 pm - 7.30 pm', $g_r_class_time)) == true) {
							$key = array_search('6.00 pm - 7.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("8.00 pm - 9.30 pm", $g_r_class_time))) {
						//if (($key = array_search('8.00 pm - 9.30', $g_r_class_time)) == true) {
							$key = array_search('8.00 pm - 9.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_seven = true;
					}else if($class == "8.00 pm - 9.30 pm" && $s_seven == false){
						if ((in_array("7.00 pm - 8.30 pm", $g_r_class_time))) {
						//if (($key = array_search('7.00 pm - 8.30 pm', $g_r_class_time)) == true) {
							$key = array_search('7.00 pm - 8.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						if ((in_array("9.00 pm - 10.30 pm", $g_r_class_time))) {
						//if (($key = array_search('9.00 pm - 10.30 pm', $g_r_class_time)) == true) {
							$key = array_search('9.00 pm - 10.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
						$s_eight = true;
					}else if($class == "9.00 pm - 10.30 pm" && $s_eight == true){
						if ((in_array("8.00 pm - 9.30 pm", $g_r_class_time))) {
						//if (($key = array_search('8.00 pm - 9.30 pm', $g_r_class_time)) == true) {
							$key = array_search('8.00 pm - 9.30 pm', $g_r_class_time);
							unset($g_r_class_time[$key]);
						}
					}
					//print_r($g_r_class_time);
				}

			//	print_r($r_class_time);
/* 				foreach($class_time as $ct){
					$cst[] = $ct;
				} */
				$class_time = array_values($class_time);
				$g_r_class_time = array_values($g_r_class_time);
			//	print_r($class_time);
			//	print_r($r_class_time);
				DB::table('classes')->where('user_id',$request->teacher_id)->where('gls_id',$request->gls)->update(['students_amount'=>$get_classes->students_amount+1]);
				$classes = new Student_book_classes;
				$classes->time_slot=json_encode($class_time);
				$classes->class_id=$request->class_id;
				$classes->type=$request->type;
				$classes->user_id=$user_id;
				$classes->module_id=$request->module_id;
				$classes->gls_id=$request->gls;
				$classes->status='active';
				$classes->save();
				foreach($class_time as $class){
					$data['class_id']=$request->class_id;
					$data['book_class_id']=$classes->id;
					$data['time_slot']=$class;
					$data['user_id']=$user_id;
					$data['teacher_id']=$request->teacher_id;
					$data['created_at']=date("Y-m-d H:m:i");
					DB::table('classes_booked_timeslot')->insert($data);
				}
				$get_book_class = DB::table('classes_booked_timeslot')->select("time_slot")->where('class_id',$request->class_id)->where('teacher_id',$request->teacher_id)->get();
				foreach($get_book_class as $class){
					$key = array_search($class->time_slot, $g_r_class_time);
					unset($g_r_class_time[$key]);
				}

				$g_r_class_time = array_values($g_r_class_time);
				$users = DB::table('users')->where('id',$user_id)->first();
				$log_data['message']= $users->email." Succesfully booked a class";
				$log_data['type']='class';
				$log_data['user_id']=$user_id;
				$log_data['action_id']=$classes->id;
				$this->generalController->logs($log_data);
				$book_count = DB::table('classes_booked_timeslot')->where('teacher_id',$request->teacher_id)
				->where('class_id',$request->class_id)->count();
				$token_amount = '-180';
				if($book_count == 4 && $request->type != 'private'){
					DB::table('classes')->where('id',$get_classes->id)->update(['status'=>'active', 'class_time'=>json_encode($g_r_class_time)]);
					$get_time_classes = DB::table('classes')->where('id',$request->class_id)->first()->class_time;
					if(count(json_decode($get_time_classes)) == 0){
						DB::table('classes')->where('id',$get_classes->id)->update(['is_active'=>1]);
					}
					$get_all_booked_class = DB::table('classes_booked_timeslot')->where('class_id',$request->class_id)->get();
					$announcement_api = new Announcement([
						'title'  => "Your Class active with $book_count students",
						'user_id'  => $request->teacher_id,
						'description'  =>  "Your Class active with $book_count students",
						'announcement_date'  => $request->class_date,
						'announcement_time' => $g_r_class_time[0],
						'announcement_type'=>'schedule',
					]);
					$announcement_api->save();
					foreach($get_all_booked_class as $booked_class){
						$users = DB::table('users')->where('id',$booked_class->user_id)->first();
						$etoken = new Etoken;
						$etoken->added_by=$users->id;
						$etoken->token_amount= $token_amount;
						$etoken->user_id=$booked_class->user_id;
						$etoken->save();

						$log_data['message']= $users->username." is debited with ".$token_amount." etokens. for booked class #".$get_classes->class_id;
						$log_data['type']='payment';
						$log_data['user_id']=$booked_class->user_id;
						$log_data['action_id']=$etoken->id;
						$this->generalController->logs($log_data);
						$announcement_api = new Announcement([
							'title'  => "Class Booked",
							'user_id'  => $booked_class->user_id,
							'description'  => "Your class booked",
							'announcement_date'  => $request->class_date,
							'announcement_time' => $booked_class->time_slot,
							'announcement_type'=>'schedule',
						]);
						$announcement_api->save();
					}
				}
				if($book_count > 4  && $request->type != 'private'){
					$users = DB::table('users')->where('id',$user_id)->first();
					$etoken = new Etoken;
					$etoken->added_by=$users->id;
					$etoken->token_amount= $token_amount;
					$etoken->user_id=$user_id;
					$etoken->save();
					$log_data['message']= $users->username." is debited with ".$token_amount." etokens. for booked class #".$get_classes->class_id;
					$log_data['type']='payment';
					$log_data['user_id']=$user_id;
					$log_data['action_id']=$etoken->id;
					$this->generalController->logs($log_data);
					$announcement_api = new Announcement([
						'title'  => "Class Booked",
						'user_id'  => $user_id,
						'description'  => "Your class booked",
						'announcement_date'  => $request->class_date,
						'announcement_time' => $g_r_class_time[0],
						'announcement_type'=>'schedule',
					]);
					$announcement_api->save();
				}
				if($request->type == 'private'){
					DB::table('classes')->where('id',$get_classes->id)->update(['status'=>'active','class_time'=>json_encode($g_r_class_time)]);
					$get_time_classes = DB::table('classes')->where('id',$request->class_id)->first()->class_time;
					if(count(json_decode($get_time_classes)) == 0){
						DB::table('classes')->where('id',$get_classes->id)->update(['is_active'=>1]);
					}
					$users = DB::table('users')->where('id',$user_id)->first();
					$etoken = new Etoken;
					$etoken->added_by=$users->id;
					$etoken->token_amount= $token_amount;
					$etoken->user_id=$user_id;
					$etoken->save();
					$log_data['message']= $users->username." is debited with ".$token_amount." etokens. for booked class #".$get_classes->class_id;
					$log_data['type']='payment';
					$log_data['user_id']=$user_id;
					$log_data['action_id']=$etoken->id;
					$this->generalController->logs($log_data);
					$msg = '180 tokens are deducted from your account';
					$announcement_api = new Announcement([
						'title'  => "Class Booked",
						'user_id'  => $user_id,
						'description'  => "Your class booked",
						'announcement_date'  => $request->class_date,
						'announcement_time' => $class_time[0],
						'announcement_type'=>'schedule',
					]);
					$announcement_api->save();
					$announcement_api = new Announcement([
						'title'  => "Your Class active with $book_count students",
						'user_id'  => $request->teacher_id,
						'description'  =>  "Your Class active with $book_count students",
						'announcement_date'  => $get_classes->class_date,
						'announcement_time' => $class_time[0],
						'announcement_type'=>'schedule',
					]);
					$announcement_api->save();
				}
			}
			$pending =  Student_book_classes::select("student_book_classes.*","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as title")
			->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
			->leftjoin('modules','modules.id','=','student_book_classes.module_id')
			->leftjoin('classes','classes.id','=','student_book_classes.class_id')
			->where('student_book_classes.user_id',$user_id)
			->where('classes.status','pending')
			->get(100);
			$pendings = array();
			$actives = array();
			foreach($pending as $cd){
				$timeslot = array();
				foreach(json_decode($cd->time_slot) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->c_class_id)->where('teacher_id',$cd->teacher_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->time_slot = json_encode($timeslot);
				$pendings[]=$cd;
			}
			$classes['pending'] = $pendings;
			$active =  Student_book_classes::select("student_book_classes.*","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as title")
			->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
			->leftjoin('modules','modules.id','=','student_book_classes.module_id')
			->leftjoin('classes','classes.id','=','student_book_classes.class_id')
			->where('student_book_classes.user_id',$user_id)
			->where('classes.status','active')
			->get(100);

			foreach($active as $cd){
				$timeslot = array();
				foreach(json_decode($cd->time_slot) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->c_class_id)->where('teacher_id',$cd->teacher_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->time_slot = json_encode($timeslot);
				$actives[]=$cd;
			}
			$classes['active'] = $actives;
            return response()->json(['status'=>200,'message'=>'Class Booked Successfully. '.$msg,'data'=>$classes]);

         }catch(\Exception $e){
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }

    }


    public function list(Request $request)
    {
        try{
			$filter = $request->query('q');
			if (!empty($filter)) {
				$classes = Classes::select("classes.*", "gls.name as name", "users.username as username")
				->leftjoin('gls','gls.id','=','classes.gls_id')
				->leftjoin('users','users.id','=','classes.user_id')
				->where('type', 'like', '%'.$filter.'%')
				->paginate(10);
				foreach($classes as $cd){
					$cd->active_time_slot = $ct = DB::table('classes_booked_timeslot')->select('time_slot')->where('class_id',$cd->id)->get();
					$all_classes[]=$cd;
				}
				$classes->data= $all_classes;

			} else {
				$classes = Classes::select("classes.*", "gls.name as name", "users.username as username")
				->leftjoin('gls','gls.id','=','classes.gls_id')
				->leftjoin('users','users.id','=','classes.user_id')
				->paginate(10);
				foreach($classes as $cd){
					$cd->active_time_slot = $ct = DB::table('classes_booked_timeslot')->select('time_slot')->where('class_id',$cd->id)->get();
					$all_classes[]=$cd;
				}
				$classes->data= $all_classes;
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $classes
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }

     }
    public function list_book(Request $request,$id)
    {
        try{
			$filter = $request->query('q');
			$time = $request->query('time');
			if (!empty($filter)) {
				$classes = Classes::select("classes.*", "gls.name as name", "users.username as username")
				->leftjoin('gls','gls.id','=','classes.gls_id')
				->leftjoin('users','users.id','=','classes.user_id')
				->where('type', 'like', '%'.$filter.'%')
				->paginate(10);
			} else {

				$classes = Student_book_classes::select("student_book_classes.*", "gls.name as name","modules.title as title", "users.username as username")
				->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
				->leftjoin('modules','modules.id','=','student_book_classes.module_id')
				->leftjoin('users','users.id','=','student_book_classes.user_id')
				->where('student_book_classes.class_id',$id)
				->paginate(10);
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $classes
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }

	}
    public function add_student_attendance(Request $request, $id){
		$user_id = $request->user('sanctum')->id;
		$students =DB::table('students')->where('user_id',$user_id)->first();
		$user_id = $students->parent_id;
		$classes = Student_book_classes::where("class_id",$id)->where("user_id",$user_id)->update(["is_attend"=>1]);
	}
    public function get_attendances(Request $request){
	$user_id = $request->user('sanctum')->id;
	$class =  Student_book_classes::select("student_book_classes.*","classes.day","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as moduel_title","students.student_name")
	->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
	->leftjoin('modules','modules.id','=','student_book_classes.module_id')
	->leftjoin('classes','classes.id','=','student_book_classes.class_id')
	->leftjoin('parents','student_book_classes.user_id','=','parents.user_id')
	->leftjoin('students','students.parent_id','=','parents.user_id')
	->where('classes.user_id',$user_id)
	->where('classes.status','active')
	->get(100);
	$get_all_booked_class = DB::table('classes_booked_timeslot')
	->leftjoin('classes','classes.id','=','classes_booked_timeslot.class_id')
	->where('classes_booked_timeslot.teacher_id',$user_id)
	->where('classes.class_date',date("Y-m-d"))
	->get();
	return response()->json(array(
		'status' => 'success',
		'pages' => $class,
		'get_all_booked_class' => $get_all_booked_class
		),
		200
	);
	}
    public function latest_teacher_class(Request $request){
		$user_id = $request->user('sanctum')->id;
		$active = Classes::select(DB::raw('min(classes.class_date) as `class_date`'), "classes.id", "classes_booked_timeslot.time_slot as class_time","classes.id")
		->leftjoin('classes_booked_timeslot','classes.id','=','classes_booked_timeslot.class_id')
		->where('classes.status',"active")
		->where('classes.user_id',$user_id)
		->groupBy('classes.class_date')
		->first();
		$active->class_time =array_values( explode(",",$active->class_time));
		if($active){
	//	$get_all_booked_class = DB::table('classes_booked_timeslot')->where('class_id',$active->id)->where('teacher_id',$user_id)->get();
		return response()->json(array(
			'status' => 'success',
			'data' => $active,
		),200);
		}else{
		return response()->json(array(
			'status' => 'success',
			'data' => [],
		),200);
		}
	}
    public function latest_parents_class(Request $request){
		$user_id = $request->user('sanctum')->id;
		$active = Student_book_classes::select(DB::raw('min(classes.class_date) as `class_date`'),  "student_book_classes.time_slot as class_time","classes.class_date","classes.id")
		->leftjoin('classes','classes.id','=','student_book_classes.class_id')
		->where('classes.status',"active")
		->where('student_book_classes.user_id',$user_id)
		->groupBy('classes.class_date')
		->first();
		if($active){
		return response()->json(array(
			'status' => 'success',
			'data' => $active,
		),200);
		}else{
		return response()->json(array(
			'status' => 'success',
			'data' => [],
		),200);
		}
	}
    public function latest_student_class(Request $request){
		$user_id = $request->user('sanctum')->id;
		$students =DB::table('students')->where('user_id',$user_id)->first();
		$user_id = $students->parent_id;
		$active = Student_book_classes::select(DB::raw('min(classes.class_date) as `class_date`'),  "student_book_classes.time_slot as class_time","classes.class_date","classes.id")
		->leftjoin('classes','classes.id','=','student_book_classes.class_id')
		->where('classes.status',"active")
		->where('student_book_classes.user_id',$user_id)
		->groupBy('classes.class_date')
		->first();
		if($active){
		return response()->json(array(
			'status' => 'success',
			'data' => $active,
		),200);
		}else{
		return response()->json(array(
			'status' => 'success',
			'data' => [],
		),200);
		}
	}
    public function teacher_class(Request $request)
    {
        try{
			$user_id = $request->user('sanctum')->id;
			$pending = Classes::select("classes.*", "gls.name as name")
			->leftjoin('gls','gls.id','=','classes.gls_id')
			->where('classes.status','pending')
			->where('classes.user_id',$user_id)
			->get(100);
			$pendings = array();
			$actives = array();
			foreach($pending as $cd){
				$timeslot = array();
				foreach(json_decode($cd->class_time) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->id)->where('teacher_id',$cd->user_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}

				$cd->class_time_array = json_decode($cd->class_time);
				$cd->class_time = json_encode($timeslot);
				$pendings[]=$cd;
			}
			$classes['pending'] = $pendings;
			$active = Classes::select("classes.*", "gls.name as name")
			->leftjoin('gls','gls.id','=','classes.gls_id')
			->where('classes.status','active')
			->where('classes.user_id',$user_id)
			->get(100);
			foreach($active as $cd){
				$timeslot = array();
				foreach(json_decode($cd->class_time) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->id)->where('teacher_id',$cd->user_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->class_time = json_encode($timeslot);
				$cd->class_time_array = json_decode($cd->class_time);
				$actives[]=$cd;
			}
			$classes['active'] = $actives;
            return response()->json(array(
                'status' => 'success',
                'data' => $classes,
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }

     }
   public function student_class(Request $request)
    {
        try{
			$id = $request->user('sanctum')->id;
			$data=array();
			$students =DB::table('students')->where('user_id',$id)->first();
			$id = $students->parent_id;
			$pending =  Student_book_classes::select("student_book_classes.*","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as title")
			->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
			->leftjoin('modules','modules.id','=','student_book_classes.module_id')
			->leftjoin('classes','classes.id','=','student_book_classes.class_id')
			->where('student_book_classes.user_id',$id)
			->where('classes.status','pending')
			->get(100);
			$pendings = array();
			$actives = array();
			foreach($pending as $cd){
				$timeslot = array();
				foreach(json_decode($cd->time_slot) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->class_id)->where('teacher_id',$cd->teacher_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->time_slot = json_encode($timeslot);
				$pendings[]=$cd;
			}
			$classes['pending'] = $pendings;
			$active =  Student_book_classes::select("student_book_classes.*","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as title")
			->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
			->leftjoin('modules','modules.id','=','student_book_classes.module_id')
			->leftjoin('classes','classes.id','=','student_book_classes.class_id')
			->where('student_book_classes.user_id',$id)
			->where('classes.status','active')
			->get(100);

			foreach($active as $cd){
				$timeslot = array();
				foreach(json_decode($cd->time_slot) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->c_class_id)->where('teacher_id',$cd->teacher_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->time_slot = json_encode($timeslot);
				$actives[]=$cd;
			}
			$classes['active'] = $actives;
            return response()->json(array(
                'status' => 'success',
                'data' => $classes,
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }

     }
    public function parents_class(Request $request)
    {
        try{
			$id = $request->user('sanctum')->id;
			$pending =  Student_book_classes::select("student_book_classes.*","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as title")
			->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
			->leftjoin('modules','modules.id','=','student_book_classes.module_id')
			->leftjoin('classes','classes.id','=','student_book_classes.class_id')
			->where('student_book_classes.user_id',$id)
			->where('classes.status','pending')
			->get(100);
			$pendings = array();
			$actives = array();
			foreach($pending as $cd){
				$timeslot = array();
				foreach(json_decode($cd->time_slot) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->c_class_id)->where('teacher_id',$cd->teacher_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->time_slot = json_encode($timeslot);
				$pendings[]=$cd;
			}
			$classes['pending'] = $pendings;
			$active =  Student_book_classes::select("student_book_classes.*","classes.id as c_class_id","classes.class_id","classes.user_id as teacher_id","gls.name as name","modules.title as title")
			->leftjoin('gls','gls.id','=','student_book_classes.gls_id')
			->leftjoin('modules','modules.id','=','student_book_classes.module_id')
			->leftjoin('classes','classes.id','=','student_book_classes.class_id')
			->where('student_book_classes.user_id',$id)
			->where('classes.status','active')
			->get(100);

			foreach($active as $cd){
				$timeslot = array();
				foreach(json_decode($cd->time_slot) as $class){
					$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->c_class_id)->where('teacher_id',$cd->teacher_id)->count();
					$ar['time'] = $class;
					$ar['student'] = $ct;
					$timeslot[] = $ar;
				}
				$cd->time_slot = json_encode($timeslot);
				$actives[]=$cd;
			}
			$classes['active'] = $actives;
            return response()->json(array(
                'status' => 'success',
                'data' => $classes,
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


    public function delete($id) {

        try{
		DB::table('classes_booked_timeslot')->where('class_id',$id)->delete();
		DB::table('student_book_classes')->where('class_id',$id)->delete();
		Classes::destroy($id);
        return response()->json(['status'=>200,'message'=>'Gls Deleted Successfully']);

    }catch(\Exception $e){
           DB::rollback();
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
    }

}
