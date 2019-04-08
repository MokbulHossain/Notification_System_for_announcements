@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.teacher_side_navbar')
       </div>

       <div class="col-md-9">

        <a href="{{route('add_announcement')}}" class="btn btn-primary" style="margin-bottom: 10px;">Add Announcement</a>
       @if(count($data)>0)
         @foreach($data as $value)
          <div class="panel panel-default">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
                       <div class="col-md-2">
                  @if($teacher->photo != null)
                <img src="{{url('storage/teacher_image/'.$teacher->id.'.jpg')}}" style="height: 100px;width: 100px;border-radius: 50%;">
                @else
                 <img src="{{url('img/user_logo.png')}}" style="height: 100px;width: 100px;border-radius: 50%;">
                 @endif
                 </div>
                 <div class="col-md-10" style="margin-top: 40px;">
                  <span style="margin-left: -44px;"> {{$teacher->name}} </span>
                  <p>
                   <form action="{{route('delete_announcement',['id'=>$value->id])}}" method="post">
                       {{csrf_field()}}
                    <a href="{{route('edit_announcement',['id'=>$value->id])}}" class="btn btn-success" >Edit </a>
                     <input type="submit" class="btn btn-danger" value="Delete">
                   </form></p>
                 </div>
                    </div>
                 
                 <div class="col-md-4">
                   <b>Course :</b> {{$value->course_name}}
                 </div>
                 <div class="col-md-4">
                   <b>Semister :</b> {{$value->semister_name}}
                 </div>
                   <div class="col-md-4">
                   <b>Update Date Time :</b> {{$value->updated_at}}
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