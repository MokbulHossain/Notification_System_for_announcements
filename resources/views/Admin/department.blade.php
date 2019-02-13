@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
       	<div id="add_department" class="col-md-12">
       		<form action="{{route('add_department')}}" method="post">
       			  {{ csrf_field() }}

       			  <div class="form-group{{ $errors->has('department_name') ? ' has-error' : '' }}">
                            <label for="department_name" class="col-md-2 control-label">Deaprtment Name : </label>

                            <div class="col-md-5">
                                <input id="department_name" type="text" class="form-control" name="department_name" value="{{ old('department_name') }}" required autofocus>

                                @if ($errors->has('department_name'))
                                    <span class="help-block ">
                                        <strong>{{ $errors->first('department_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-1">
                            	<input type="submit" class="btn  btn-primary" value="ADD">
                            </div>
                        </div>
       			
       		</form>
       	</div>
       	<div class="col-md-12">
        @if($data->isNotEmpty()) @php $i=1; @endphp
          <table class="table" style="margin-top: 10px;">
          	<tr>
          		<th>SL</th>
          		<th>Department Name</th>
          		<th>Action</th>
          	</tr>
	         @foreach($data as $value)     
	           	 <tr>
	           	 	<td>{{$i}}</td>
	           	 	<td>{{$value->department_name}}</td>
	           	 	<td>
	           	 		<form method="post" action="{{route('delete_department',['id'=>$value->id])}}">{{ csrf_field() }}
	           	 		<input type="submit" class="btn btn-danger" value="Delete">
	           	 		</form>
	           	 	</td>
	           	 </tr>
	           @php $i++; @endphp
	         @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Department is Empty !!
         </h1>
        @endif
     </div>
  </div>
</div>
</div>
 
@endsection