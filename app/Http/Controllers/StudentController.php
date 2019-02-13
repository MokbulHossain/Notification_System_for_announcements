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

class StudentController extends Controller
{
    public function index(){
    	$data = Student::find(session('id'));
    	return view('Student.home',compact('data'));
    }

    public function course_list(){
    	$semisters = Semister::all();
    	return view ('Student.course_list',compact('semisters'));
    }
    public function search_student_course(Request $request){
    	$semisters = Semister::all();
      $data = DB::table('student_course')
             ->where('semister_name',$request->input('semister_name'))
             ->where('student_id',session('id'))
             ->join('courses','courses.id','student_course.course_id')
             ->get();
      return view('Student.view_course_list',compact('semisters','data'));
    }

    public  function announcements(){
      $data = DB::table('student_course')->where('student_course.student_id',session('id'))
            ->join('courses','courses.id','student_course.course_id')
            ->join('announcements','announcements.course_id','student_course.course_id')
            ->join('teachers','teachers.id','announcements.teacher_id')
            ->select('announcements.updated_at as post_datetime','announcements.*','announcements.id as post_id','courses.*','teachers.name','teachers.photo')
            ->orderBy('announcements.id','DESC')
            ->get();
      return view('Student.announcement',compact('data'));
    }
}
