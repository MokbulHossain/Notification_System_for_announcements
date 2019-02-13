<?php


Route::get('/',function(){return view('index');});


//Student.........................
Route::get('student/login',function(){return view('auth.student_login');})->name('student_login');
Route::post('student/login','Auth\LoginController@student_login')->name('student_login');
Route::prefix('student')->group(function () {
	//start student middleware.........
 Route::middleware('student')->group(function () {
  Route::get('home','StudentController@index');
  Route::get('course_list','StudentController@course_list');
  Route::post('search_student_course','StudentController@search_student_course')->name('search_student_course');
  Route::get('announcements','StudentController@announcements');
});   
//end student middleware................
});


//Teacher...........................
Route::get('teacher/login',function(){return view('auth.teacher_login');})->name('teacher_login');
Route::post('teacher/login','Auth\LoginController@teacher_login')->name('teacher_login');
Route::prefix('teacher')->group(function () {
	//start teacher middleware.........
 Route::middleware('teacher')->group(function () {
  Route::get('home','TeacherController@index');
  Route::get('course_list','TeacherController@course_list');
  Route::post('search_teacher_course','TeacherController@search_teacher_course')->name('search_teacher_course');
  Route::get('announcements','TeacherController@announcements');
  Route::get('add_announcement','TeacherController@add_announcement')->name('add_announcement');
  Route::get('edit_announcement/{id}','TeacherController@edit_announcement')->name('edit_announcement');
  Route::post('delete_announcement/{id}','TeacherController@delete_announcement')->name('delete_announcement');
});   
//end teacher middleware................
});


//Admin................................
Route::get('admin/login',function(){return view('auth.admin_login');})->name('admin_login');
Route::post('admin/login','Auth\LoginController@admin_login')->name('admin_login');
Route::prefix('admin')->group(function () {
	//start admin middleware.........
 Route::middleware('admin')->group(function () {
  Route::get('home','AdminController@index');

  Route::get('student_assign_in_course','AdminController@student_assign_in_course');
  Route::post('add_student_course','AdminController@add_student_course')->name('add_student_course');
  Route::post('delete_student_course/{id}','AdminController@delete_student_course')->name('delete_student_course');
  
  Route::get('teacher_assign_in_course','AdminController@teacher_assign_in_course');
  Route::post('add_teacher_course','AdminController@add_teacher_course')->name('add_teacher_course');
  Route::post('delete_teacher_course/{id}','AdminController@delete_teacher_course')->name('delete_teacher_course');

  Route::get('student','AdminController@student');
  Route::get('add_student',function(){ $departments = App\Department::all();return view('Admin.add_student',compact('departments'));})->name('add_student');
  Route::post('add_student','AdminController@add_student')->name('add_student');
  Route::get('view_student/{id}','AdminController@view_student')->name('view_student');
  Route::get('edit_student/{id}','AdminController@edit_student')->name('edit_student');
  Route::post('update_student','AdminController@update_student')->name('update_student');
  Route::post('delete_student/{id}','AdminController@delete_student')->name('delete_student');

  Route::get('teacher','AdminController@teacher');
  Route::get('view_teacher/{id}','AdminController@view_teacher')->name('view_teacher');
  Route::get('edit_teacher/{id}','AdminController@edit_teacher')->name('edit_teacher');
  Route::post('delete_teacher/{id}','AdminController@delete_teacher')->name('delete_teacher');
  Route::get('add_teacher',function(){return view('Admin.add_teacher');});
  Route::post('add_teacher','AdminController@add_teacher')->name('add_teacher');
  Route::post('update_teacher','AdminController@update_teacher')->name('update_teacher');

  Route::get('course','AdminController@course');
  Route::post('add_course','AdminController@add_course')->name('add_course');
  Route::post('delete_course/{id}','AdminController@delete_course')->name('delete_course');

  Route::get('semister','AdminController@semister');
  Route::post('add_semister','AdminController@add_semister')->name('add_semister');
  Route::post('delete_semister/{id}','AdminController@delete_semister')->name('delete_semister');

  Route::get('department','AdminController@department');
  Route::post('add_department','AdminController@add_department')->name('add_department');
  Route::Post('delete_department/{id}','AdminController@delete_department')->name('delete_department');

  Route::get('section','AdminController@section');
  Route::post('add_section','AdminController@add_section')->name('add_section');
  Route::Post('delete_section/{id}','AdminController@delete_section')->name('delete_section');
});   
//end admin middleware................
});

Auth::routes();
