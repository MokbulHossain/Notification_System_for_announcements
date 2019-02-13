@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.teacher_side_navbar')
       </div>

       <div class="col-md-9">
       	  @if($data->photo != null)
          <img src="{{url('storage/teacher_image/$data->photo')}}" style="height: 200px;width: 200px;border-radius: 50%;margin-left:295px;">
          @else
           <img src="{{url('img/user_logo.png')}}" style="height: 200px;width: 200px;border-radius: 50%;margin-left:295px;">
           @endif
          <table style="width: 80%;" class="table">
          	<tr>
          		<th>Id : </th>
          		<td>{{$data->id}}</td>
          		<th>Name : </th>
          		<td>{{$data->name}}</td>
          	</tr>
          	<tr>
          		<th>Email : </th>
          		<td>{{$data->email}}</td>
          		<th>Rank : </th>
          		<td>{{$data->rank}}</td>
          	</tr>
          	<tr>
          		<th>Present Address : </th>
          		<td>{{$data->present_address}}</td>
          		<th>Parmanent Address : </th>
          		<td>{{$data->parmanent_address}}</td>
          	</tr>
          	<tr>
          		<th>Phone No : </th>
          		<td>{{$data->phone_no}}</td>
          		<td> </td>
          		<td></td>
          	</tr>
          </table>
          </div>
    </div>
  </div>
 
@endsection