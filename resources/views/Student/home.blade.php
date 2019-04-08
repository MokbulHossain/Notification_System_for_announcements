@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.student_side_navbar')
       </div>
       <div class="col-md-9" id="data_show">
        <a class="btn btn-primary" onclick="edit()">Edit</a>
       	  @if($data->photo != null)
          <img src="{{url('storage/student_image/'.$data->id.'.jpg')}}" style="height: 200px;width: 200px;border-radius: 50%;margin-left:295px;">
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
          		<th>Department : </th>
          		<td>{{$data->department_name}}</td>
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

           <div class="col-md-9" id="data_hide" style="display: none">
            <form method="post" action="{{route('update_student_info')}}" enctype="multipart/form-data">
              {{csrf_field()}}
          @if($data->photo != null)
          <img src="{{url('storage/student_image/'.$data->id.'.jpg')}}" id="image" style="height: 200px;width: 200px;border-radius: 50%;margin-left:295px;">
          @else
           <img src="{{url('img/user_logo.png')}}" id="image" style="height: 200px;width: 200px;border-radius: 50%;margin-left:295px;">
           @endif
           <input type="file" name="photo" style="margin-left:295px;" onchange="setImage(this)" value="00">
          <table style="width: 80%;" class="table">
            <tr>
              <th>Id : </th>
              <td>{{$data->id}}</td>
              <th>Name : </th>
              <td><input type="text" name="name" class="form-control" value="{{$data->name}}"></td>
            </tr>
            <tr>
              <th>Email : </th>
              <td>{{$data->email}}</td>
              <th>Department : </th>
              <td>{{$data->department_name}}</td>
            </tr>
            <tr>
              <th>Present Address : </th>
              <td><input type="text" name="present_address" value="{{$data->present_address}}" class="form-control"></td>
              <th>Parmanent Address : </th>
              <td><input type="text" name="parmanent_address" value="{{$data->parmanent_address}}" class="form-control"></td>
            </tr>
            <tr>
              <th>Phone No : </th>
              <td><input type="text" name="phone_no" value="{{$data->phone_no}}" class="form-control"></td>
              <td> </td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><a class="btn btn-danger" onclick="cancle()">Cancle </a> <input type="submit" class="btn btn-success" value="Update"></td>
              <td></td>
            </tr>
          </table>
          </form>
          </div>


    </div>
  </div>
   <script type="text/javascript">
    function setImage(input){
     if (input.files && input.files[0]) {
           var reader = new FileReader();
           reader.onload = function(e) {
          $('#image').attr('src', e.target.result);
          }
         reader.readAsDataURL(input.files[0]);
        }
       }

       function edit(){
        document.getElementById('data_show').style.display='none';
        document.getElementById('data_hide').style.display='block';
       }
        function cancle(){
        document.getElementById('data_show').style.display='block';
        document.getElementById('data_hide').style.display='none';
       }
  </script>
@endsection