@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
       	<a href="{{url('admin/add_student')}}" class="btn btn-primary">Add Student</a>
        @if($data->isNotEmpty()) @php $i=1; @endphp
          <table class="table" style="margin-top: 10px;">
          	<tr>
          		<th>Id</th>
          		<th>Name</th>
          		<th>Email</th>
          		<th>Department</th>
          		<th>Action</th>
          	</tr>
	         @foreach($data as $value)     
	           	 <tr>
	           	 	<td>{{$value->id}}</td>
	           	 	<td>{{$value->name}}</td>
	           	 	<td>{{$value->email}}</td>
	           	 	<td>{{$value->department_name}}</td>
	           	 	<td>
	           	 		<a href="{{route('view_student',['id'=>$value->id])}}">View | </a>
	           	 		<a href="{{route('edit_student',['id'=>$value->id])}}">Edit | </a>
	           	 		<a style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('logout-form{{$i}}').submit();"> Delete</a>

                    <form id="logout-form{{$i}}" action="{{route('delete_student',['id'=>$value->id])}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
	           	 	</td>
	           	 </tr>
	           @php $i++; @endphp
	         @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Student List is Empty !!
         </h1>
        @endif
  </div>
</div>
</div>
 
@endsection