@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.teacher_side_navbar')
       </div>

       <div class="col-md-9">
       	<div id="add_department" class="col-md-12" style="border: 2px solid #000;border-radius: 12px;">
          <form action="{{route('search_teacher_course')}}" method="post">
              {{ csrf_field() }}

              <div class="form-group">
                            <label for="Semister" class="col-md-2 control-label" style="text-align: right">Semister : </label>
                            <div class="col-md-2" class="form-control">
                              <select id="Semister" name="semister_name" class="form-control">
                                @foreach($semisters as $semister)
                                <option value="{{$semister->semister_name}}">{{$semister->semister_name}}</option>
                                @endforeach
                              </select><br>
                            </div>

                            <div class="col-md-1">
                              <input type="submit" value="Search" class="btn btn-primary"> 
                            </div>
              </div>
            </form> 
          </div>
         @if($data->isNotEmpty())
         <div class="col-md-12">
           <table style="width: 100%;" class="table">
             <tr>
               <th>Course Name</th>
               <th>Course Code</th>
               <th>Section</th>
               <th>Semister</th>
             </tr>
             @foreach($data as $value)
             <tr>
               <td>{{$value->course_name}}</td>
               <td>{{$value->course_code}}</td>
               <td>{{$value->section_name}}</td>
               <td>{{$value->semister_name}}</td>
             </tr>
             @endforeach
           </table>
         </div>
         @else
         <h2 style="color: red">Collection is Empty</h2>
         @endif
          </div>
    </div>
  </div>
 
@endsection