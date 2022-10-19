<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Parents;
use App\Models\Agents;
use App\Models\Etoken;
use App\Models\Student_book_classes;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index() {

        $latest_token_purchases = Etoken::with('user')->orderBy('id','DESC')->limit(5)->get();
        $latest_booked_classes = Student_book_classes::with('classes','modules')->where('status','active')->orderBY('id','DESC')->limit(10)->get();
        $agents_data = Parents::with('user','agents.agent_user_name','token')->limit(5)->get();
        $agents = Agents::count();
        $students = Student::count();
        $parents = Parents::count();
        $teachers = Teacher::count();
        $e_token = Etoken::count();
        $total_sum_amount = Etoken::whereMonth('created_at', Carbon::now()->month)->sum('token_amount');

        $data= [
            'students' => $students,
            'parents' => $parents,
            'teachers' => $teachers,
            'agents' => $agents,
            'e_token' => $e_token,
            'total_sum_amount' => $total_sum_amount,
            'agents_data' => $agents_data,
            'latest_booked_classes' => $latest_booked_classes,
            'latest_token_purchases' => $latest_token_purchases,
        ];

        return  response()->json($data);

    }

    public function analytics() {

        $classes_conducted = DB::table('classes_booked_timeslot')->count();

        $data= [
            'classes_conducted' => $classes_conducted,
        ];

        return  response()->json($data);
    }
}
