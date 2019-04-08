@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.teacher_side_navbar')
       </div>

       <div class="col-md-9">

          <div class="panel panel-default">
                <div class="panel-body">
                	@if (session('status'))
                        <div class="alert alert-danger">
                            {{ session('status') }}
                        </div>
                    @endif
                  <div class="row">
                    <div class="col-md-12">
                       <form action="{{route('submit_edit_announcement')}}" method="post">
              {{ csrf_field() }}
                <input type="hidden" name="announement_id" value="{{$announcement->id}}">
              <div class="form-group col-md-12">
                            <label for="Semister" class="col-md-2 control-label" style="text-align: right">Select Semister : </label>
                            <div class="col-md-8" class="form-control">
                              <select id="Semister" name="semister_name" class="form-control" required="true" onchange="select_semister()">
                              	<option value="{{$announcement->semister_name}}">{{$announcement->semister_name}}</option>
                                @foreach($semisters as $semister)
                                <option value="{{$semister->semister_name}}">{{$semister->semister_name}}</option>
                                @endforeach
                              </select><br>
                            </div>
              </div>

                <div class="form-group col-md-12">
                            <label for="change_it" class="col-md-2 control-label" style="text-align: right">Select Course : </label>
                            <div class="col-md-8" class="form-control">
                              <select id="change_it" name="course_id" class="form-control" required="true">
                               <option value="{{$announcement->course->id}}">{{$announcement->course->course_name}}</option>
                              </select><br>
                            </div>
              </div>

               <div class="form-group col-md-12">
                            <label for="type" class="col-md-2 control-label" style="text-align: right">Select Announcement Type : </label>
                            <div class="col-md-8" class="form-control">
                              <select id="type" name="announcement_type" class="form-control" >
                               <option value="{{$announcement->announcment_type}}">{{$announcement->announcment_type}}</option>
                               <option value="Presentation">Presentation</option>
                               <option value="Assignment">Assignment</option>
                               <option value="Quiz">Quiz</option>
                              </select><br>
                            </div>
              </div>

                <div class="form-group col-md-12">
                            <label for="datetime" class="col-md-2 control-label" style="text-align: right">Action Date : </label>
                            <div class="col-md-8" class="form-control">
                              <input type="date" class="form-control" name="date" required="true" id="date" value="{{$announcement->action_date}}">
                              <br>
                            </div>
              </div>

               <div class="form-group col-md-12">
                            <label for="time" class="col-md-2 control-label" style="text-align: right">Action Time : </label>
                            <div class="col-md-8" class="form-control">
                              <input type="time" class="form-control" name="time" required="true" id="time" value="{{$announcement->action_time}}">
                              <br>
                            </div>
              </div>

               <div class="form-group col-md-12">
                            <label for="editor1" class="col-md-2 control-label" style="text-align: right">Details : </label>
                            <div class="col-md-8" class="form-control">
                              <textarea name="details" required="true" id="editor1" rows="10" cols="80">
                                 {{$announcement->details}}
                              </textarea><br>
                            </div>
              </div>

               <div class="form-group col-md-offset-2">
                         <input type="submit" class="btn btn-primary" value="Submit">
              </div>

              
            </form>
                    </div>
                 
                 
                  </div>
                </div>
            </div>
  
       </div>
    </div>
  </div>
   <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
 <script type="text/javascript">

 CKEDITOR.replace( 'editor1' );
 function select_semister(){
 	     var s_name = document.getElementById("Semister").value;
               var change_it = document.getElementById("change_it");
                   $.ajax({
                    type: 'POST',
                    url: 'select_course',
                    data: {
                     "_token" : $('meta[name=_token]').attr('content'), 
                      s_name: s_name 
                    },   
                    success: function (msg) { 
                    	change_it.innerHTML=msg;
                    	//alert(msg);

                    }
                });
        
             
 }
 </script>
@endsection