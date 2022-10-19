<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PublicholidayController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\GlsController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\Classroom_activityController;
use App\Http\Controllers\Eprep_activityController;
use App\Http\Controllers\EtokenController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentAssignController;
use App\Http\Controllers\ErevisionNotesController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::get('/clear-cache', function() {
    $output = [];
    \Artisan::call('cache:clear', $output);
    \Artisan::call('config:clear', $output);
    \Artisan::call('route:clear', $output);
    \Artisan::call('config:cache', $output);
    \Artisan::call('view:cache', $output);
    \Artisan::call('storage:link', $output);
    dd($output);
});

Route::group(['middleware' => 'auth:sanctum'], function() {
	Route::post('teacher/add',[TeacherController::class,'store']);
	Route::post('agent/add',[TeacherController::class,'agent_add']);
	Route::get('teacher/show', [TeacherController::class, 'show']);
	Route::get('teacher/view/{id}', [TeacherController::class, 'view']);
	Route::post('teacher/update/{id}', [TeacherController::class, 'update']);
	Route::get('teacher/get-gl/{id}', [TeacherController::class, 'get_gls']);
	Route::post('teacher/add-permissions/{id}', [TeacherController::class, 'teacher_gl_permission']);
	Route::get('teacher/get-permissions', [TeacherController::class, 'get_teacher_gls']);

	Route::post('parents/add',[ParentsController::class,'create']);
	Route::get('parents/view', [ParentsController::class, 'parents']);

	Route::post('student/add',[StudentController::class,'student']);
	Route::get('student/view', [StudentController::class, 'show']);
	Route::get('student/get-student-gls', [StudentController::class, 'get_student_gls']);
	Route::get('student/get-student-gls-check', [StudentController::class, 'get_student_gls_check']);

	Route::post('announcement/store',[AnnouncementController::class,'store']);
    Route::get('announcement/list', [AnnouncementController::class, 'list']);
    Route::get('announcement/list_admin', [AnnouncementController::class, 'list_admin']);
    Route::get('announcement/delete/{id}', [AnnouncementController::class, 'delete']);

	Route::post('public-holiday/store',[PublicholidayController::class,'store']);
    Route::get('public-holiday/list', [PublicholidayController::class, 'list']);
    Route::get('public-holiday/list_admin', [PublicholidayController::class, 'list_admin']);
    Route::get('public-holiday/delete/{id}', [PublicholidayController::class, 'delete']);
    Route::get('public-holiday/holiday', [PublicholidayController::class, 'holiday']);

	Route::post('classes/store',[ClassesController::class,'store']);
	Route::post('classes/book-class',[ClassesController::class,'book_class']);
    Route::get('classes/parents-class', [ClassesController::class, 'parents_class']);
    Route::get('classes/teacher-class', [ClassesController::class, 'teacher_class']);
    Route::get('classes/student-class', [ClassesController::class, 'student_class']);
    Route::get('classes/list', [ClassesController::class, 'list']);
    Route::get('classes/list-book/{id}', [ClassesController::class, 'list_book']);
    Route::get('classes/list_admin', [ClassesController::class, 'list_admin']);
    Route::get('classes/delete/{id}', [ClassesController::class, 'delete']);
    Route::get('classes/latest-teacher-class', [ClassesController::class, 'latest_teacher_class']);
    Route::get('classes/latest-student-class', [ClassesController::class, 'latest_student_class']);
    Route::get('classes/latest-parents-class', [ClassesController::class, 'latest_parents_class']);
    Route::get('classes/get-attendances', [ClassesController::class, 'get_attendances']);
    Route::get('classes/add-student-attendances/{id}', [ClassesController::class, 'add_student_attendance']);

	Route::post('chat/send',[GeneralController::class,'send_message']);
	Route::get('chat/list',[GeneralController::class,'chat_list']);
	Route::get('chat/contact',[GeneralController::class,'chat_contact']);
	Route::get('chat/chats/{id}',[GeneralController::class,'chats']);
	Route::get('chat/chats_user/{id}',[GeneralController::class,'chats_user']);
	Route::get('get-week',[GeneralController::class,'get_week']);
	Route::get('get-week-by-teacher/{gls_id}/{teacher_id}',[GeneralController::class,'get_week_by_teacher']);
	Route::get('logs/{type}',[GeneralController::class,'get_logs']);


  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('module/store',[ModuleController::class,'store']);
    Route::get('module/list', [ModuleController::class, 'show']);
    Route::get('module/search/{id}', [ModuleController::class, 'search']);
    Route::post('module/update/{id}',[ModuleController::class,'update']);
    Route::get('module/delete/{id}', [ModuleController::class, 'destroy']);

  });

  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('lesson/store',[LessonController::class,'store']);
    Route::get('lesson/list', [LessonController::class, 'show']);
    Route::get('lesson/search/{id}', [LessonController::class, 'search']);
    Route::post('lesson/update/{id}',[LessonController::class,'update']);
    Route::get('lesson/delete/{id}', [LessonController::class, 'destroy']);

  });

  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('gls/store',[GlsController::class,'store']);
    Route::get('gls/list', [GlsController::class, 'show']);
    Route::post('gls/update/{id}',[GlsController::class,'update']);
    Route::get('gls/delete/{id}', [GlsController::class, 'destroy']);
    Route::get('gls/search', [GlsController::class, 'search']);

  });
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('component/store',[ComponentController::class,'store']);
    Route::get('component/list/{type}', [ComponentController::class, 'show']);
    Route::get('component/list-all/{type}', [ComponentController::class, 'list_all']);
    Route::post('component/update/{id}',[ComponentController::class,'update']);
    Route::get('component/delete/{id}', [ComponentController::class, 'destroy']);
    Route::get('component/search', [ComponentController::class, 'search']);

  });
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('add-notes/store',[ErevisionNotesController::class,'store']);
    Route::get('add-notes/list/{id}', [ErevisionNotesController::class, 'show']);
    Route::get('add-notes/list-all', [ErevisionNotesController::class, 'list_all']);
    Route::post('add-notes/update/{id}',[ErevisionNotesController::class,'update']);
    Route::get('add-notes/delete/{id}', [ErevisionNotesController::class, 'destroy']);
    Route::get('add-notes/search', [ErevisionNotesController::class, 'search']);

  });
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('classroom-activity/store',[Classroom_activityController::class,'store']);
    Route::get('classroom-activity/list/{id}', [Classroom_activityController::class, 'show']);
    Route::post('classroom-activity/update/{id}',[Classroom_activityController::class,'update']);
    Route::get('classroom-activity/delete/{id}', [Classroom_activityController::class, 'destroy']);
    Route::get('classroom-activity/search', [Classroom_activityController::class, 'search']);

  });
  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('eprep-activity/store',[Eprep_activityController::class,'store']);
    Route::get('eprep-activity/list/{id}', [Eprep_activityController::class, 'show']);
    Route::post('eprep-activity/update/{id}',[Eprep_activityController::class,'update']);
    Route::get('eprep-activity/delete/{id}', [Eprep_activityController::class, 'destroy']);
    Route::get('eprep-activity/search', [Eprep_activityController::class, 'search']);

  });

  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('e-token/store',[EtokenController::class,'store']);
    Route::get('e-token/list/{id}', [EtokenController::class, 'show']);
    Route::post('e-token/update/{id}',[EtokenController::class,'update']);
    Route::get('e-token/delete/{id}', [EtokenController::class, 'destroy']);
    Route::get('e-token/search', [EtokenController::class, 'search']);
  });

  Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('assign-module/store',[StudentAssignController::class,'store']);
    Route::get('assign-module/list/{id}', [StudentAssignController::class, 'show']);
    Route::post('assign-module/update/{id}',[StudentAssignController::class,'update']);
    Route::get('assign-module/delete/{id}', [StudentAssignController::class, 'destroy']);
    Route::get('assign-module/search', [StudentAssignController::class, 'search']);
  });


  Route::group(['middleware' => 'auth:sanctum'], function() {
});


});
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    Route::group(['middleware' => 'auth:api'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'user']);
    });
});

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('analytics', [DashboardController::class, 'analytics']);
