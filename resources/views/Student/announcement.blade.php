@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.student_side_navbar')
       </div>

       <div class="col-md-9">
        <div style="background-color: #1d8c1b; display: inline-block;width: 20px;height: 20px"> </div> Complete |
         <div style="background-color: #8c1b1b; display: inline-block;width: 20px;height: 20px"> </div> Start within 5 to 0 days|</span>
         <div style="background-color: #3644a9; display: inline-block;width: 20px;height: 20px"> </div> Panding</span>
        @if(count($data)>0)
         @foreach($data as $value)
         @php 
            date_default_timezone_set('Asia/Dhaka');
           $action_date=date_create($value->action_date);
            $current_date=date_create(date("Y-m-d"));
            $diff=date_diff($action_date,$current_date);
          @endphp
          @if($action_date<$current_date)
          <div class="panel panel-default" style="background-color: #1d8c1b;color: white">
          @elseif($diff->format("%a") < 5)
          <div class="panel panel-default" style="background-color: #8c1b1b;color: white">
          
          @else
          <div class="panel panel-default" style="background-color: #3644a9;color: white">
          @endif
                <div class="panel-body"> 
                  <div class="row">
                    <div class="col-md-12">
                       <div class="col-md-2">
                  @if($value->photo != null)
                <img src="{{url('storage/teacher_image/$value->photo')}}" style="height: 100px;width: 100px;border-radius: 50%;">
                @else
                 <img src="{{url('img/user_logo.png')}}" style="height: 100px;width: 100px;border-radius: 50%;">
                 @endif
                 </div>
                 <div class="col-md-10" style="margin-top: 40px;">
                  <span style="margin-left: -44px;"> {{$value->name}} </span>
                 </div>
                    </div>
                 
                 <div class="col-md-4">
                   <b>Course :</b> {{$value->course_name}}
                 </div>
                 <div class="col-md-4">
                   <b>Semister :</b> {{$value->semister_name}}
                 </div>
                 <div class="col-md-4">
                   <b>Update Date Time :</b> {{$value->post_datetime}}
                 </div>
                 <div class="col-md-4">
                   <b>Announcement Type : {{$value->announcment_type}}</b>
                 </div>
                 <div class="col-md-4">
                   <b>{{$value->announcment_type}} Date Time:</b> {{$value->action_date}} {{$value->action_time}}
                 </div>
                
                  <div class="col-md-12">
                    <div style="border: 1px solid black;padding: 15px">
                      {!!$value->details!!}
                    </div>
                    
                  </div>
                  </div>
                </div>
            </div>
          @endforeach 
          @endif 
       </div>
    </div>
  </div>
 
@endsection