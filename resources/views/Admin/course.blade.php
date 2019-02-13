@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
       	<div id="add_department" class="col-md-12">
       		<form action="{{route('add_course')}}" method="post">
       			  {{ csrf_field() }}

       			  <div class="form-group">
                            <label for="Semister" class="col-md-2 control-label" style="text-align: right">Course Name : </label>

                            <div class="col-md-3" class="form-control">
                            	<input type="text" name="course_name" class="form-control">
                            </div>
                            <label for="" style="text-align: right" class="col-md-2 control-label">Course Code : </label>
                              <div class="col-md-3">
                            	<input type="text" name="course_code" class="form-control">
                            </div>

                            <div class="col-md-1">
                            	<input type="submit" class="btn  btn-primary" value="ADD">
                            </div>
                            <div class="col-md-12">
                            	 @if ($errors->has('course_name'))
					                <span style="color: red">
					                    <strong>{{ $errors->first('course_name') }}</strong>
					                </span>
					             @endif
                            </div>
                        </div>       			
       		</form>

       	</div>
       	<div class="col-md-12">
        @if($data->isNotEmpty()) @php $i=1; @endphp
          <table class="table" style="margin-top: 10px;">
          	<tr>
          		<th>SL</th>
          		<th>Course Name</th>
          		<th>Course Code</th>
          		<th>Action</th>
          	</tr>
	         @foreach($data as $value)     
	           	 <tr>
	           	 	<td>{{$i}}</td>
	           	 	<td>{{$value->course_name}}</td>
	           	 	<td>{{$value->course_code}}</td>
	           	 	<td>
	           	 		<form method="post" action="{{route('delete_course',['id'=>$value->id])}}">{{ csrf_field() }}
	           	 		<input type="submit" class="btn btn-danger" value="Delete">
	           	 		</form>
	           	 	</td>
	           	 </tr>
	           @php $i++; @endphp
	         @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Course is Empty !!
         </h1>
        @endif
     </div>
  </div>
</div>
</div>
 
@endsection