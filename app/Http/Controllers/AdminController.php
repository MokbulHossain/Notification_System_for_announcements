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

class AdminController extends Controller
{
   public function index(){
     $students=Student::count();
      $courses=Course::count();
      $departments=Department::count();
   	return view('Admin.home',compact('students','courses','departments'));
   }

   public function student_assign_in_course(){
   	$data= DB::table('students')
           ->join('student_course','student_course.student_id','students.id')
           ->join('courses','courses.id','student_course.course_id')
           ->select('student_course.*','student_course.id as student_course_id','courses.*','students.name','students.department_name')
           ->get();
      $students=Student::all();
      $courses=Course::all();
      $semisters=Semister::all();
      $sections=Section::all();
      $departments=Department::all();
     return view('Admin.student_assign_in_course',compact('data','students','courses','semisters','sections','departments'));
   }

   public function add_student_course(Request $request){
        $exsist = DB::table('student_course')->where([
              ['student_id',$request->input('student_id')],
              ['course_id',$request->input('course_id')],
              ['semister_name',$request->input('semister_name')],
              ['section_name',$request->input('section_name')],
             ])->count();
     if ($exsist === 0) {
      $msg=DB::table('student_course')->insert([
        'student_id'=>$request->input('student_id'),
        'course_id'=>$request->input('course_id'),
        'semister_name'=>$request->input('semister_name'),
        'section_name'=>$request->input('section_name')]);
     if (!$msg) {
      $error=['assign_error'=>'There have an Error,Pleaze Try Again !!'];
        return redirect()->back()->withErrors($error);
     }
     return redirect()->back();
     }
     else{
      $error=['assign_error'=>'This info Already Exsist !!'];
        return redirect()->back()->withErrors($error);
     }

   }

   public function delete_student_course($id){
      DB::table('student_course')->where('id',$id)->delete();
      return redirect()->back();
   }

   public function teacher_assign_in_course(){
    	$data= DB::table('teachers')
           ->join('course_teacher','course_teacher.teacher_id','teachers.id')
           ->join('courses','courses.id','course_teacher.course_id')
           ->select('course_teacher.*','course_teacher.id as course_teacher_id','courses.*','teachers.name')
           ->get();
	    $teachers=Teacher::all();
	    $courses=Course::all();
	    $semisters=Semister::all();
	    $sections=Section::all();
	    $departments=Department::all();
     return view('Admin.teacher_assign_in_course',compact('data','teachers','courses','semisters','sections','departments'));
   }

   public function add_teacher_course(Request $request){
   	$exsist = DB::table('course_teacher')->where([
              ['teacher_id',$request->input('teacher_id')],
              ['course_id',$request->input('course_id')],
              ['semister_name',$request->input('semister_name')],
              ['department_name',$request->input('department_name')],
              ['section_name',$request->input('section_name')],
   	         ])->count();
     if ($exsist === 0) {
     	$msg=DB::table('course_teacher')->insert([
   	 	  'teacher_id'=>$request->input('teacher_id'),
   	 	  'course_id'=>$request->input('course_id'),
   	 	  'semister_name'=>$request->input('semister_name'),
   	 	  'department_name'=>$request->input('department_name'),
   	 	  'section_name'=>$request->input('section_name')]);
   	 if (!$msg) {
   	 	$error=['assign_error'=>'There have an Error,Pleaze Try Again !!'];
        return redirect()->back()->withErrors($error);
   	 }
   	 return redirect()->back();
     }
     else{
     	$error=['assign_error'=>'This info Already Exsist !!'];
        return redirect()->back()->withErrors($error);
     }
   	 
   }

   public function delete_teacher_course($id){
   	DB::table('course_teacher')->where('id',$id)->delete();
   	return redirect()->back();
   }

   public function student(){
    $data = Student::all();
    return view('Admin.student',compact('data'));
   }
   public function add_student(Request $request){
         Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();
      $student = new Student;
      $student->name = $request->input('name');
      $student->department_name = $request->input('department_name');
      $student->email = $request->input('email');
      $student->password = bcrypt($request->input('password'));
      if ($student->save()) {
      	return redirect('admin/student');
      }
      $error=['name'=>'There have an Error,Pleaze Try Again !!'];
      return redirect()->back()->withErrors($error);
   }
   public function view_student($id){
   $data = Student::find($id);
   	return view('Admin.view_student',compact('data'));
   }
   public function edit_student($id){
   	$data = Student::find($id);
   	$departments = Department::all();
   	return view('Admin.edit_student',compact('data','departments'));
   }
   public function update_student(Request $request){
   	 $student = Student::find($request->input('id'));
   	$student->name = $request->input('name');
   	$student->department_name = $request->input('department_name');
   	$student->email = $request->input('email');
   	if ($request->input('password') != null) {
   		$student->password = $request->input('password');
   	}
   	if ($student->save()) {
   	   return redirect('admin/student');
      }
  $error=['name'=>'There have an Error,Pleaze Try Again !!'];
  return redirect()->back()->withErrors($error);
   }

   public function delete_student($id){
   	Student::where('id',$id)->delete();
   	return redirect()->back();
   }



   public function teacher(){
   	$data = Teacher::all();
   	return view('Admin.teacher',compact('data'));
   }
    public function add_teacher(Request $request){
      Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:6|confirmed',
        ])->validate();
      $teacher = new Teacher;
      $teacher->name = $request->input('name');
      $teacher->rank = $request->input('rank');
      $teacher->email = $request->input('email');
      $teacher->password = bcrypt($request->input('password'));
      if ($teacher->save()) {
      	return redirect('admin/teacher');
      }
      $error=['name'=>'There have an Error,Pleaze Try Again !!'];
      return redirect()->back()->withErrors($error);
   } 
   public function view_teacher($id){
   	$data = Teacher::find($id);
   	return view('Admin.view_teacher',compact('data'));
   }

   public function edit_teacher($id){
   	$data = Teacher::find($id);
   	return view('Admin.edit_teacher',compact('data'));
   }
   public function update_teacher(Request $request){
   	$teacher = Teacher::find($request->input('id'));
   	$teacher->name = $request->input('name');
   	$teacher->rank = $request->input('rank');
   	$teacher->email = $request->input('email');
   	if ($request->input('password') != null) {
   		$teacher->password = $request->input('password');
   	}
   	if ($teacher->save()) {
   	   return redirect('admin/teacher');
      }
  $error=['name'=>'There have an Error,Pleaze Try Again !!'];
  return redirect()->back()->withErrors($error);
   }

   public function delete_teacher($id){
   	Teacher::where('id',$id)->delete();
   	return redirect()->back();
   }


   public function course(){
    $data=Course::all();
    return view('Admin.course',compact('data'));
   }
   public function add_course(Request $request){
    	$exsist=Course::where('course_name',$request->input('course_name'))
   	        ->where('course_code',$request->input('course_code'))
   	        ->count();
     if($exsist === 0){
     	$course = new Course;
	   	$course->course_name = $request->input('course_name');
	   	$course->course_code = $request->input('course_code');
	   	 if ($course->save()) {
	   	 	return redirect()->back();
	   	 }
	  $error=['course_name'=>'There have an Error,Pleaze Try Again !!'];
      return redirect()->back()->withErrors($error); 
     }
     $error=['course_name'=>'This Name Already Exsist !!'];
     return redirect()->back()->withErrors($error); 
   }

   public function delete_course($id){
    Course::where('id',$id)->delete();
   	return redirect()->back();
   }


   public function semister(){
    $data=Semister::all();
    return view('Admin.semister',compact('data'));
   }
    public function add_semister(Request $request){
    	$exsist=Semister::where('semister_name',$request->input('semister').'-'.$request->input('year'))->count();
     if($exsist === 0){
     	$semister = new Semister;
	   	$semister->semister_name = $request->input('semister').'-'.$request->input('year');
	   	 if ($semister->save()) {
	   	 	return redirect()->back();
	   	 }
	  $error=['semister_name'=>'There have an Error,Pleaze Try Again !!'];
      return redirect()->back()->withErrors($error); 
     }
     $error=['semister_name'=>'This Name Already Exsist !!'];
     return redirect()->back()->withErrors($error); 
     
   }

   public function delete_semister($id){
    Semister::where('id',$id)->delete();
   	return redirect()->back();
   }

   public function department(){
    $data=Department::all();
    return view('Admin.department',compact('data'));
   }
   public function add_department(Request $request){
   	$exsist=Department::where('department_name',$request->input('department_name'))->count();
     if($exsist === 0){
   	 $department = new Department;
   	 $department->department_name = $request->input('department_name');
   	 if ($department->save()) {
   	 	return redirect()->back();
   	 }
     $error=['department_name'=>'There have an Error,Pleaze Try Again !!'];
     return redirect()->back()->withErrors($error); 
   }
   $error=['department_name'=>'This Name Already Exsist !!'];
     return redirect()->back()->withErrors($error);
   }

   public function delete_department($id){
   	Department::where('id',$id)->delete();
   	return redirect()->back();
   }

   public function section(){
   $data=Section::all();
    return view('Admin.section',compact('data'));
   }
   public function add_section(Request $request){
    $exsist=Section::where('section_name',$request->input('campus').'-'.$request->input('section'))->count();
     if($exsist === 0){
   	 $section = new Section;
   	 $section->section_name = $request->input('campus').'-'.$request->input('section');
   	 if ($section->save()) {
   	 	return redirect()->back();
   	 }
     $error=['section_name'=>'There have an Error,Pleaze Try Again !!'];
     return redirect()->back()->withErrors($error); 
   }
   $error=['section_name'=>'This Name Already Exsist !!'];
     return redirect()->back()->withErrors($error);
   }
   public function delete_section($id){
   	Section::where('id',$id)->delete();
   	return redirect()->back();
   }
}
