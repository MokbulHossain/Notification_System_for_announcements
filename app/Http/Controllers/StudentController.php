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

    public function presentation(){

      $data = DB::table('student_course')->where('student_course.student_id',session('id'))
            ->join('courses','courses.id','student_course.course_id')
            ->join('announcements','announcements.course_id','student_course.course_id')
            ->where('announcements.announcment_type','presentation')
            ->join('teachers','teachers.id','announcements.teacher_id')
            ->select('announcements.updated_at as post_datetime','announcements.*','announcements.id as post_id','courses.*','teachers.name','teachers.photo')
            ->orderBy('announcements.id','DESC')
            ->get();
      return view('Student.announcement',compact('data'));

    }
    public function assignment(){
       $data = DB::table('student_course')->where('student_course.student_id',session('id'))
            ->join('courses','courses.id','student_course.course_id')
            ->join('announcements','announcements.course_id','student_course.course_id')
            ->where('announcements.announcment_type','assignment')
            ->join('teachers','teachers.id','announcements.teacher_id')
            ->select('announcements.updated_at as post_datetime','announcements.*','announcements.id as post_id','courses.*','teachers.name','teachers.photo')
            ->orderBy('announcements.id','DESC')
            ->get();
      return view('Student.announcement',compact('data'));
    }
    public function quiz(){
       $data = DB::table('student_course')->where('student_course.student_id',session('id'))
            ->join('courses','courses.id','student_course.course_id')
            ->join('announcements','announcements.course_id','student_course.course_id')
            ->where('announcements.announcment_type','like','%quiz%')
            ->join('teachers','teachers.id','announcements.teacher_id')
            ->select('announcements.updated_at as post_datetime','announcements.*','announcements.id as post_id','courses.*','teachers.name','teachers.photo')
            ->orderBy('announcements.id','DESC')
            ->get();
      return view('Student.announcement',compact('data'));
    }
    public function update_student_info(Request $request){
            $data = $request->all();
          $students =Student::find(session('id')); $i=0;
          foreach ($data as $key => $value) {
            if($i !=0){
              $students->$key = $value;
            }
            $i++;
          }
          if ($students->save()) {
              if(!empty($request->file('photo'))){
                $data['photo']->storeAs('public/student_image',session('id').'.jpg');
              }
          }
         
        return redirect()->back();

    }
}
