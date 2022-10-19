<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;  
use Illuminate\Http\Request; 
use Illuminate\Http\File;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Models\User; 
use Validator;
use DB;
use App\Mail\Email; 
use Illuminate\Support\Facades\Mail;
use stdClass;

class GeneralController extends Controller{
    public $successStatus = 200;

	 public function get_logs(Request $request, $type)
    {
        try{ 
			$filter = $request->query('q');
			if (!empty($filter)) {
				$action_logs = DB::table('action_logs')->where('type', $type)->where('message', 'like', '%'.$filter.'%')->paginate(10);
			} else {
				$action_logs =DB::table('action_logs')->where('type', $type)->paginate(10);
			}
            return response()->json(array(
                'status' => 'success',
                'pages' => $action_logs
				),
                200
            );
        }catch(\Exception $e){
            DB::rollback();	
            return response()->json(['status'=>400,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], 400);
        }
     
     }
    /* Send Mail */
    public function logs($data){	 
		$data['created_at']=date("Y-m-d H:m:i");
		$data['updated_at']=date("Y-m-d H:m:i");
		DB::table('action_logs')->insert($data);
	}
    public function send_message(Request $request){	 
		$input = $request->all(); 
		$user_id =$request->user('sanctum')->id;
		$data['from_id']=$user_id;
		$data['to_id']=$request->contactId;
		$data['message']=$request->message;
		DB::table('chat')->insert($data);
		$data['newMessageData']['message'] = $request->message;
		$data['newMessageData']['senderId'] = $user_id;
		$data['newMessageData']['time'] = date('Y-m-d H:m:i');
		 return response()->json(array(
			'status' => 'success',
			'data' => $data, 
			),
			200
		);
	}  
    public function chat_contact(Request $request){	  
		 $user_id =$request->user('sanctum')->id;
		$users =DB::table('users')->select('teachers.*','users.*','users.id as id') 
		->whereIn('users.role',[2,4])
		->leftjoin('teachers','users.id','=','teachers.user_id')->get();
		foreach($users as $ud){
			$contact['id'] = $ud->id;
			if($ud->role == 2){
				$contact['fullName'] = $ud->first_name." ".$ud->last_name;
			}else{
				$contact['fullName'] = $ud->name;
			}
			
			$contact['email'] = $ud->email;
			$contact['status'] = 'online';
			$contact['lastMessage'] = '';
			$contact['unseenMsgs'] = '';
			$contact['avatar'] = '';
			$contact['role'] = $ud->role;
			$contacts[]=$contact;
		}
		 
		$chat =DB::table('chat')->where('from_id',$user_id) ->get();
		$profileUser =DB::table('users')->where('id',$user_id) ->get()->first();
		 return response()->json(array(
			'status' => 'success',
			'contacts' => $contacts,
			'profileUser' => $profileUser,
			'chat' => $chat->toArray(),
			'chatsContacts' => $contacts),
			200
		);
	}
    public function chats(Request $request,$id){
		$user_id =$request->user('sanctum')->id;
		$ud =DB::table('users')->select('teachers.*','users.*','users.id as id') 
		->where('users.id',$id)
		->leftjoin('teachers','users.id','=','teachers.user_id')->get()->first();
		$contact['id'] = $ud->id;
		if($ud->role == 2){
			$contact['fullName'] = $ud->first_name." ".$ud->last_name;
		}else{
			$contact['fullName'] = $ud->name;
		}
		
		$contact['email'] = $ud->email;
		$contact['status'] = 'online';
		$contact['lastMessage'] = '';
		$contact['unseenMsgs'] = '';
		$contact['avatar'] = '';
		$contact['role'] = $ud->role;
		$user_chat =DB::table('chat')->where('to_id',$id)->orWhere('from_id',$user_id)->where('from_id',$id)->orWhere('to_id',$user_id)->get();
		$chat=[];
		foreach($user_chat as $cd){ 
			$cd_list['message'] = $cd->message; 
			$cd_list['time'] = $cd->created_at; 
			$cd_list['senderId'] = $cd->from_id; 
			$chat[]=$cd_list;
		}
		$chats['chat']['userId']= $id;
		$chats['chat']['unseenMsgs']= 1;
		$chats['chat']['chat']= $chat; 
		$chats['contact']= $contact; 
		return response()->json(array(
			'status' => 'success',
			'data' => $chats),
			200
		);
	}
    public function chats_user(Request $request,$id){
		$user_id =$request->user('sanctum')->id;
		$ud =DB::table('users')->select('teachers.*','users.*','users.id as id') 
		->where('users.id',$id)
		->leftjoin('teachers','users.id','=','teachers.user_id')->get()->first();
		$contact['id'] = $ud->id;
		if($ud->role == 2){
			$contact['fullName'] = $ud->first_name." ".$ud->last_name;
		}else{
			$contact['fullName'] = $ud->name;
		}
		
		$contact['email'] = $ud->email;
		$contact['status'] = 'online';
		$contact['lastMessage'] = '';
		$contact['unseenMsgs'] = '';
		$contact['avatar'] = '';
		$contact['role'] = $ud->role;
		$user_chat =DB::table('chat')->where('to_id',$user_id)->orWhere('from_id',$id)->where('from_id',$user_id)->orWhere('to_id',$id)->get();
		$chat=[];
		foreach($user_chat as $cd){ 
			$cd_list['message'] = $cd->message; 
			$cd_list['time'] = $cd->created_at; 
			$cd_list['senderId'] = $cd->from_id; 
			$chat[]=$cd_list;
		}
		$chats['chat']['userId']= $id;
		$chats['chat']['unseenMsgs']= 1;
		$chats['chat']['chat']= $chat; 
		$chats['contact']= $contact; 
		return response()->json(array(
			'status' => 'success',
			'data' => $chats),
			200
		);
	}
    public function chat_list(){	 
		$input = $request->all();
		DB::table('chat')->insert($input);
	}
	public function get_week(){	 
		$weeks = [];
		$week = [];
	      
        $saturday = strtotime('monday this week');
		$public_holidays = DB::table('public_holidays')->select('date')->get();      
        foreach (range(0, 6) as $day) {
            $week['date'] = date("Y-m-d", (($day * 86400) + $saturday));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|1';
            $dff = date('d', strtotime($week['date']));
			$checktime = strtotime($dff);
			if(time() > $checktime){
			//	$week['dff']  = $dff;
			//	$week['s'] = date('Y-m-d', strtotime($week['date']. ' + 7 days'));
			}else{
				
			// $week['dff']  = $dff;
			//	$week['s'] = $week['date'];
			}
			$now = strtotime(date("Y-m-d H:i:s",strtotime($week['date'])));
			$paymentDate = date("Y-m-d H:i:s");
			$contractDateBegin =  strtotime(date('Y-m-d H:i:s', strtotime($paymentDate. ' + 1 days')));
			$contractDateEnd =  strtotime(date('Y-m-d H:i:s', strtotime($paymentDate. ' + 3 days')));

			if($now > $contractDateEnd) {
				 $week['date'] = $week['date'];
			} else {
				 $week['date'] = date('Y-m-d', strtotime($week['date']. ' + 7 days'));
				
			}    
         //   $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays);
            $week['disabled'] = false;
			$weeks['1'][] = $week;
        }
		/*$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|2';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays);
			$weeks['2'][] = $week;
        }  
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
            $week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|3';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays);
			$weeks['3'][] = $week;
        }  
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|4';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays);
			$weeks['4'][] = $week;
        }  
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|5';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays);
			$weeks['5'][] = $week;
        }   
		$last_week = $week['date'];*/
		$weeks_all[] = $weeks;
		return response()->json(array(
			'status' => 'success',
			'data' => $weeks_all[0]
			),
			200
		);
	} 
	public function get_week_by_teacher(Request $request,$gls_id,$teacher_id){	 
		$weeks = [];
		$week = [];
	      
        $saturday = strtotime('monday this week');
		$classes = DB::table('classes')->where('type',$request->type)->whereOr('type','both')->where('is_active',0)->where('user_id',$teacher_id)->where('gls_id',$gls_id)->get();    
	
 	if(count($classes) > 0){
		foreach($classes as $cd){
			$timeslot = array();
			foreach(json_decode($cd->class_time) as $class){
				$ct = DB::table('classes_booked_timeslot')->where('time_slot',$class)->where('class_id',$cd->id)->where('teacher_id',$cd->user_id)->count();
				$ar['time'] = $class;
				$ar['student'] = $ct;
				$timeslot[] = $ar;
			}	
			$cd->class_time = json_encode($timeslot);  
			$actives[]=$cd;
		}		
		$public_holidays = DB::table('public_holidays')->select('date')->get();      
        foreach (range(0, 6) as $day) {
            $week['date'] = date("Y-m-d", (($day * 86400) + $saturday));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|1';
			$dff = date('d', strtotime($week['date']));
			$checktime = strtotime($dff);
			if(time() > $checktime){
			//	$week['dff']  = $dff;
			//	$week['s'] = date('Y-m-d', strtotime($week['date']. ' + 7 days'));
			}else{
				
			// $week['dff']  = $dff;
			//	$week['s'] = $week['date'];
			}
			$now = strtotime(date("Y-m-d H:i:s",strtotime($week['date'])));
			$paymentDate = date("Y-m-d H:i:s");
			$contractDateBegin =  strtotime(date('Y-m-d H:i:s', strtotime($paymentDate. ' + 1 days')));
			$contractDateEnd =  strtotime(date('Y-m-d H:i:s', strtotime($paymentDate. ' + 3 days')));

			if($now > $contractDateEnd) {
				 $week['date'] = $week['date'];
			} else {
				 $week['date'] = date('Y-m-d', strtotime($week['date']. ' + 7 days'));
				
			}    
			$classes = DB::table('classes')->where('type',$request->type)->whereOr('type','both')->where('is_active',0)->where('user_id',$teacher_id)->where('class_date',$week['date'])->where('gls_id',$gls_id)->first();    
			$week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays,$classes);
			$weeks['1'][] = $week;
        }
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|2';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays,$classes);
			$weeks['2'][] = $week;
        }  
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
            $week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|3';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays,$classes);
			$weeks['3'][] = $week;
        }  
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|4';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays,$classes);
			$weeks['4'][] = $week;
        }  
		$last_week = $week['date'];
        foreach (range(1, 7) as $day) { 
            $week['date'] = date('Y-m-d', strtotime("+$day day", strtotime($last_week)));
			$week['label'] = date('D', strtotime($week['date']));
            $week['value'] = date('D', strtotime($week['date'])).'|5';
            $week['disabled'] = $this->hasPublicHoliday($week['date'],$public_holidays,$classes);
			$weeks['5'][] = $week;
        }   
		$last_week = $week['date'];
		$weeks_all[] = $weeks;
		
		return response()->json(array(
			'status' => 'success',
			'data' => $weeks_all[0],
			'classes' => $actives
			),
			200
		);
		}else{
		return response()->json(array(
			'status' => "success",
			'data' => [],
			'msg' => "Class not found", 
			),
			200
		);
		}
	} 
	public function hasPublicHoliday($value, $public_holidays,$classes){
		if (isset($classes) && $classes->class_date === $value) {
			return false;
		}else{
			return true;
		} 
		return false;
	}
	/* public function hasPublicHoliday($value, $public_holidays,$classes=array()): bool {
		return false;
		foreach ($public_holidays as $object) {
			if (property_exists($object, 'date') && $object->date === $value) {
				return true;
			}else{
				foreach ($classes as $object_class) {
					if (property_exists($object_class, 'class_date') && $object_class->class_date === $value) {
						return false;
					}else{
						return true;
					}
				}
			}
		}
		return false;
	} */
    public function sendMail($userEmail,$data){		
        
        $html = view('email.'.$data['bladeName'])->with($data)->render();
        $email_data['email'] =  $userEmail;
        $email_data['name'] =  'Motkraft';
        $email_data_to['to'][] = $email_data;
        
        $email_data_to['from']['email_address_id'] =  19078;
        $email_data_to['from']['name'] =  'Motkraft';
        $email_data_to['subject'] =  $data['subject'];
        $email_data_to['body'] = $html; 
 	
		try{
			if(!empty($userEmail)):
			    	
				$userdata = $data;
			//	Mail::to($userEmail)->send(new Email($userdata));
          
				if( count(Mail::failures()) > 0 ) {	
				    
					$message = "Email sending error. They were: ";
					$emailAddress = array();
					foreach(Mail::failures() as $email_address) {
						$emailAddress[] = " - $email_address ";
					}
					$emails = implode(",",$emailAddress);
					//return response()->json(['status'=>true,'message'=>$message." ".$emails]);
					//return $message." ".$emails;
				}else{
					//return response()->json(['status'=>true,'message'=>'Email send successfully.']);
					//return 'Email send successfully.';
					 \Log::info($userEmail.json_encode(Mail::failures()));	 
	
				}
			endif;
			return true;
		}catch(\Exception $e){
		    dd($e);
			    \Log::info(json_encode($e));
		    	return true;
	 	
		//	return response()->json(['status'=>false,'message'=>'Somthing is wrong. Error : '.$e->getMessage()], $this-> successStatus); 
		}		
	} 

}
?>