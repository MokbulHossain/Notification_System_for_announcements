<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;

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


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


   View::composer(['.layouts.teacher_side_navbar'],function($view){
      $data = DB::table('announcements')->where('announcements.teacher_id',session('id'))
          ->join('courses','courses.id','announcements.course_id')
          ->select('announcements.*','courses.course_name')
          ->get();
            date_default_timezone_set('Asia/Dhaka');
            $presentation_red=0;$presentation_panding=0;
            $assignment_red=0;$assignment_panding=0;
            $quiz_red=0;$quiz_panding=0;
            foreach ($data as  $value) {     
               $action_date=date_create($value->action_date);
                $current_date=date_create(date("Y-m-d"));
                $diff=date_diff($action_date,$current_date);
               if ($value->announcment_type == 'Presentation') {
                    if($action_date<$current_date){
                       
                    }
                    elseif($diff->format("%a") < 5){
                        $presentation_red++;
                    }
                    else{ $presentation_panding++;}
                    
                }
                 elseif ($value->announcment_type == 'Assignment') {
                    if($action_date<$current_date){
                       
                    }
                    elseif($diff->format("%a") < 5){
                        $assignment_red++;
                    }
                    else{$assignment_panding++;}
                   
                }
                 else {
                   if($action_date<$current_date){
                       
                    }
                    elseif($diff->format("%a") < 5){
                        $quiz_red++;
                    }
                    else{$quiz_panding++;}
                    
                }
            }
           

            $view->with(compact('presentation_red','presentation_panding','assignment_red','assignment_panding','quiz_red','quiz_panding'));
          }); 


        View::composer(['.layouts.student_side_navbar'],function($view){
          $data = DB::table('student_course')->where('student_course.student_id',session('id'))
            ->join('courses','courses.id','student_course.course_id')
            ->join('announcements','announcements.course_id','student_course.course_id')
            ->join('teachers','teachers.id','announcements.teacher_id')
            ->select('announcements.action_date','announcements.announcment_type')
            ->orderBy('announcements.id','DESC')
            ->get();
            date_default_timezone_set('Asia/Dhaka');
            $presentation_red=0;$presentation_panding=0;
            $assignment_red=0;$assignment_panding=0;
            $quiz_red=0;$quiz_panding=0;
            foreach ($data as  $value) {     
               $action_date=date_create($value->action_date);
                $current_date=date_create(date("Y-m-d"));
               $diff=date_diff($action_date,$current_date);
                
                if ($value->announcment_type == 'Presentation') {
                    if($action_date<$current_date){
                       
                    }
                    elseif($diff->format("%a") < 5){
                        $presentation_red++;
                    }
                    else{ $presentation_panding++;}
                    
                }
                 elseif ($value->announcment_type == 'Assignment') {
                    if($action_date<$current_date){
                       
                    }
                    elseif($diff->format("%a") < 5){
                        $assignment_red++;
                    }
                    else{$assignment_panding++;}
                   
                }
                 else {
                   if($action_date<$current_date){
                       
                    }
                    elseif($diff->format("%a") < 5){
                        $quiz_red++;
                    }
                    else{$quiz_panding++;}
                    
                }
            }
           
           $view->with(compact('presentation_red','presentation_panding','assignment_red','assignment_panding','quiz_red','quiz_panding'));
          });

       

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
