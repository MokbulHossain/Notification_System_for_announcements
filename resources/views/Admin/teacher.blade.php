@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
       	<a href="{{url('admin/add_teacher')}}" class="btn btn-primary">Add Teacher</a>
        @if($data->isNotEmpty()) @php $i=1; @endphp
          <table class="table" style="margin-top: 10px;">
          	<tr>
          		<th>SL</th>
          		<th>Name</th>
          		<th>Email</th>
          		<th>Rank</th>
          		<th>Action</th>
          	</tr>
	         @foreach($data as $value)     
	           	 <tr>
	           	 	<td>{{$i}}</td>
	           	 	<td>{{$value->name}}</td>
	           	 	<td>{{$value->email}}</td>
	           	 	<td>{{$value->rank}}</td>
	           	 	<td>
	           	 		<a href="{{route('view_teacher',['id'=>$value->id])}}">View | </a>
	           	 		<a href="{{route('edit_teacher',['id'=>$value->id])}}">Edit | </a>
	           	 		<a style="cursor: pointer;" onclick="event.preventDefault(); document.getElementById('logout-form{{$i}}').submit();"> Delete</a>

                    <form id="logout-form{{$i}}" action="{{route('delete_teacher',['id'=>$value->id])}}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
	           	 	</td>
	           	 </tr>
	           @php $i++; @endphp
	         @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Teacher List is Empty !!
         </h1>
        @endif
  </div>
</div>
</div>
 
@endsection