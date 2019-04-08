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
use App\Announcement;
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
    public function presentation(){
        $teacher = Teacher::find(session('id'));
        $data = DB::table('announcements')->where('announcements.teacher_id',session('id'))
        ->where('announcements.announcment_type','Presentation')
          ->join('courses','courses.id','announcements.course_id')
          ->select('announcements.*','courses.course_name')
          ->get();
        return view('Teacher.announcements',compact('data','teacher'));
    }
     public function assignment(){
        $teacher = Teacher::find(session('id'));
        $data = DB::table('announcements')->where('announcements.teacher_id',session('id'))
        ->where('announcements.announcment_type','Assignment')
          ->join('courses','courses.id','announcements.course_id')
          ->select('announcements.*','courses.course_name')
          ->get();
        return view('Teacher.announcements',compact('data','teacher'));
    } 
    public function quiz(){
        $teacher = Teacher::find(session('id'));
        $data = DB::table('announcements')->where('announcements.teacher_id',session('id'))
        ->where('announcements.announcment_type','like','%Quiz%')
          ->join('courses','courses.id','announcements.course_id')
          ->select('announcements.*','courses.course_name')
          ->get();
        return view('Teacher.announcements',compact('data','teacher'));
    }

    public function add_announcement(){
      $semisters = Semister::all();
      return view('Teacher.create_announcement',compact('semisters'));
    }

    public function submit_announcement(Request $request){
       $announcement =new Announcement;
       $announcement->teacher_id =session('id');
       $announcement->course_id =$request->course_id;
       $announcement->semister_name =$request->semister_name;
       $announcement->announcment_type =$request->announcement_type;
       $announcement->action_date =$request->date;
       $announcement->action_time =$request->time;
       $announcement->details =$request->details;
       if ($announcement->save()) {
         return redirect('teacher/presentation');
       }
       else{return redirect()->back();}
    }
    public function select_course(Request $request){
 
        $courses = DB::table('course_teacher')->where('teacher_id',session('id'))->join('courses','course_teacher.course_id','courses.id')->where('course_teacher.semister_name',$request->s_name)->select('courses.id','courses.course_name')->get();

        $output = '<select id="change_it" name="course_id" class="form-control" required="true">';
        if(count($courses)>0){
        foreach ($courses as $value) {
          $output = $output.'<option value="'.$value->id.'">'.$value->course_name.'</option>';
        }
      }
      else{ $output =$output.'<option value="">-------</option>';}
          $output =$output.'</select>';
      return $output;      
                             
    }

    public function edit_announcement($id){
       $announcement =Announcement::find($id);
        $semisters = Semister::all();
        return view('Teacher.edit_announcement',compact('semisters','announcement'));
    }

    public function delete_announcement($id){
    	   $announcement =Announcement::find($id);
    	   $announcement->delete();
    	   return redirect()->back();
    }
    
    public function submit_edit_announcement(Request $request){
       $announcement = Announcement::find($request->announement_id);
       $announcement->course_id =$request->course_id;
       $announcement->semister_name =$request->semister_name;
       $announcement->announcment_type =$request->announcement_type;
       $announcement->action_date =$request->date;
       $announcement->action_time =$request->time;
       $announcement->details =$request->details;
       if ($announcement->save()) {
           if($request->announcement_type == 'Presentation')
           return redirect('teacher/presentation');
           elseif($request->announcement_type == 'Quiz')
           return redirect('teacher/quiz');
           else
           return redirect('teacher/assignment');
       }
       else{return redirect()->back();}
    }
    
    public function update_teacher_info(Request $request){
           $data = $request->all();
          $teacher =Teacher::find(session('id')); $i=0;
          foreach ($data as $key => $value) {
            if($i !=0){
              $teacher->$key = $value;
            }
            $i++;
          }
          if ($teacher->save()) {
              if(!empty($request->file('photo'))){
                $data['photo']->storeAs('public/teacher_image',session('id').'.jpg');
              }
          }
         
        return redirect()->back();
    }
}
