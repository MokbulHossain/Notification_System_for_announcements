<?php

namespace App\Http\Controllers\Auth;
use App\Student;
use App\Teacher;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
class LoginController 
{
  

    public function student_login(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $data=Student::where('email',$email)->first();
        if ($data != null) {
            if (Hash::check($password, $data->password)) {
                session(['Student'=>true,'auth'=>true,'id'=>$data->id,'name'=>$data->name]);
               return redirect('student/home');
            }
            else{
                $error=['password'=>'Password is not correct !!'];
                return redirect()->back()->withErrors($error); 
            }
        }
        else{
            $error=['email'=>'Email is not correct !!'];
            return redirect()->back()->withErrors($error);
        }
        
    }

     public function teacher_login(Request $request){
          $email=$request->input('email');
        $password=$request->input('password');
        $data=Teacher::where('email',$email)->first();
        if ($data != null) {
            if (Hash::check($password, $data->password)) {
                session(['Teacher'=>true,'auth'=>true,'id'=>$data->id,'name'=>$data->name]);
               return redirect('teacher/home');
            }
            else{
                $error=['password'=>'Password is not correct !!'];
                return redirect()->back()->withErrors($error); 
            }
        }
        else{
            $error=['email'=>'Email is not correct !!'];
            return redirect()->back()->withErrors($error);
        }
    }

     public function admin_login(Request $request){
        $email=$request->input('email');
        $password=$request->input('password');
        $data=Admin::where('email',$email)->first();
        if ($data != null) {
            if (Hash::check($password, $data->password)) {
                session(['Admin'=>true,'auth'=>true,'id'=>$data->id,'name'=>$data->name]);
               return redirect('admin/home');
            }
            else{
                $error=['password'=>'Password is not correct !!'];
                return redirect()->back()->withErrors($error); 
            }
        }
        else{
            $error=['email'=>'Email is not correct !!'];
            return redirect()->back()->withErrors($error);
        }
    }

    public function logout(Request $request){
            $request->session()->flush();
            return redirect('/');
    }


}
