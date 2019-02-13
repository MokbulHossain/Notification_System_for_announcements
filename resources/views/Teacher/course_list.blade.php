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
          </div>
    </div>
  </div>
 
@endsection