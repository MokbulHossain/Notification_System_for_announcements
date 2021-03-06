@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
        @if($data)
        <style type="text/css"> table tr th,td{padding: 10px;}</style>
       <div class="row">
         <div class="col-md-12" style="text-align: center;">
          @if($data->photo != null)
          <img src="{{url('storage/student_image/'.$data->id.'.jpg')}}" style="height: 200px;width: 200px;border-radius: 50%;margin-left:-150px;">
          @else
           <img src="{{url('img/user_logo.png')}}" style="height: 200px;width: 200px;border-radius: 50%;margin-left:-150px;">
           @endif
         </div>
         <div class="col-md-6">
           <table>
             <tr>
               <th>Name : </th>
               <td>{{$data->name}}</td>
             </tr>
             <tr>
               <th>Email : </th>
               <td>{{$data->email}}</td>
             </tr>
             <tr>
               <th>Department : </th>
               <td>{{$data->department_name}}</td>
             </tr>
           </table>
         </div>
         <div class="col-md-6">
           <table>
             <tr>
               <th>Parmanent Adress : </th>
               <td>{{$data->parmanent_address}}</td>
             </tr>
             <tr>
               <th>Present Address : </th>
               <td>{{$data->present_address}}</td>
             </tr>
             <tr>
               <th>Phone Number : </th>
               <td>{{$data->phone_no}}</td>
             </tr>
           </table>
         </div>
       </div>
       @else
       <h1 style="text-align: center;color: red;">This Teacher is Not Register</h1>
       @endif
       <a href="{{url('admin/student')}}" style="margin-top: 15px;" class="btn btn-primary">Back</a>
  </div>
</div>
</div>
 
@endsection