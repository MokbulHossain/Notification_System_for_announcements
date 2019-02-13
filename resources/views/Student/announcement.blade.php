@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.student_side_navbar')
       </div>

       <div class="col-md-9">
        {{--
         @foreach($data as $value)
          <div class="panel panel-default">
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
                 <div class="col-md-">
                   <b>Date Time :</b> {{$value->post_datetime}}
                 </div>
                
                  <div class="col-md-12">
                    <div style="border: 1px solid black;padding: 15px">
                      {{$value->details}}
                    </div>
                    
                  </div>
                  </div>
                </div>
            </div>
          @endforeach   --}}
       </div>
    </div>
  </div>
 
@endsection