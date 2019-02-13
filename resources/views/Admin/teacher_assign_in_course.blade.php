@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
        <div id="add_department" class="col-md-12" style="border: 2px solid #000;border-radius: 12px;">
          <form action="{{route('add_teacher_course')}}" method="post">
              {{ csrf_field() }}

              <div class="form-group">
                            <label for="Semister" class="col-md-2 control-label" style="text-align: right">Semister : </label>
                            <div class="col-md-2" class="form-control">
                              <select id="Semister" name="semister_name" class="form-control">
                                @foreach($semisters as $semister)
                                <option value="{{$semister->semister_name}}">{{$semister->semister_name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <label for="course" class="col-md-2 control-label" style="text-align: right">Course : </label>
                            <div class="col-md-2" class="form-control">
                              <select id="course" name="course_id" class="form-control">
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <script type="text/javascript">var student=[],student_info=[];</script>
                            @foreach($teachers as $teacher)
                            <script>student.push('{{$teacher->id}}');student_info['{{$teacher->id}}']='{{$teacher->name}}';</script>
                            @endforeach

                            <label for="teacher" class="col-md-2 control-label" style="text-align: right">Teacher : </label>
                            <div class="col-md-2" class="form-control">
                              <input type="text" id="teacher" name="teacher_id" class="form-control" onkeyup="check_student_id(this.value)" required ><div id="error_msg"></div><br>
                            </div>

                            <label for="department" class="col-md-2 control-label" style="text-align: right">Department : </label>
                            <div class="col-md-2" class="form-control">
                              <select id="department" name="department_name" class="form-control">
                                @foreach($departments as $department)
                                <option value="{{$department->department_name}}">{{$department->department_name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <label for="section" class="col-md-2 control-label" style="text-align: right">Section : </label>
                            <div class="col-md-2" class="form-control">
                              <select id="section" name="section_name" class="form-control">
                                @foreach($sections as $section)
                                <option value="{{$section->section_name}}">{{$section->section_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            

                            <div class="col-md-2">
                              <input type="submit" id="submit_btn"  class="btn  btn-primary" value="Assign Teacher" disabled="true"> <br>
                            </div>
                            <div class="col-md-12">
                               @if ($errors->has('assign_error'))
                          <span style="color: red">
                              <strong>{{ $errors->first('assign_error') }}</strong>
                          </span>
                       @endif <br>
                            </div>
                        </div>            
          </form>

        </div>
        <div class="col-md-12">
        @if($data->isNotEmpty()) @php $i=1; @endphp
          <table class="table" style="margin-top: 10px;">
            <tr>
              <th>(id) Teacher Name</th>
              <th>Course Name</th>
              <th>Department</th>
              <th>Section</th>
              <th>Semister</th>
              <th>Action</th>
            </tr>
           @foreach($data as $value)     
               <tr>
                <td>({{$value->teacher_id}}) {{$value->name}}</td>
                <td>{{$value->course_name}}</td>
                <td>{{$value->department_name}}</td>
                <td>{{$value->section_name}}</td>
                <td>{{$value->semister_name}}</td>
                <td>
                  <form method="post" action="{{route('delete_teacher_course',['id'=>$value->course_teacher_id])}}">{{ csrf_field() }}
                  <input type="submit" class="btn btn-danger" value="Delete">
                  </form>
                </td>
               </tr>
             @php $i++; @endphp
           @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Course Assign is Empty !!
         </h1>
        @endif
     </div>
  </div>
</div>
</div>
 

 <script type="text/javascript">
  function check_student_id(id) {
    var doc=document.getElementById('error_msg');
    if(id != ''){
    var n = student.includes(id);
    if (n == true) {
      doc.innerHTML = student_info[id];
      doc.style.color = 'green';
      document.getElementById('submit_btn').disabled = false;
    }
    else{
      doc.innerHTML = 'Not Match !!';
      doc.style.color = 'red';
      document.getElementById('submit_btn').disabled = true;
    }
  }
  else{
      doc.innerHTML = '';
      document.getElementById('submit_btn').disabled = true;
  }
    
  }
 </script>
@endsection