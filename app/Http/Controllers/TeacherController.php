<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Teacher;
use App\Admin;
use App\Department;
use App\Semister;
use App\Course;
use App\Section;
use Validator;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index(){
    	$data = Teacher::find(session('id'));
    	return view('Teacher.home',compact('data'));
    }
    public function course_list(){
    	$semisters = Semister::all();
    	return view('Teacher.course_list',compact('semisters'));
    }
    public function search_teacher_course(Request $request){
    	$semisters = Semister::all();
      $data = DB::table('course_teacher')
             ->where('semister_name',$request->input('semister_name'))
             ->where('course_teacher.teacher_id',session('id'))
             ->join('courses','courses.id','course_teacher.course_id')
             ->get();
      return view('Teacher.view_course_list',compact('semisters','data'));
    }

    public function announcements(){
    	$teacher = Teacher::find(session('id'));
    	$data = DB::table('announcements')->where('announcements.teacher_id',session('id'))
    	  ->join('courses','courses.id','announcements.course_id')
    	  ->select('announcements.*','courses.course_name')
    	  ->get();
    	return view('Teacher.announcements',compact('data','teacher'));
    }

    public function add_announcement(){

    }

    public function edit_announcement($id){

    }

    public function delete_announcement($id){
    	
    }
}
