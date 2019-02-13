@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
       	<div id="add_department" class="col-md-12">
       		<form action="{{route('add_semister')}}" method="post">
       			  {{ csrf_field() }}

       			  <div class="form-group">
                            <label for="Semister" class="col-md-2 control-label" style="text-align: right">Semister : </label>

                            <div class="col-md-3" class="form-control">
                            	<select id="Semister" name="semister" class="form-control">
                            		<option value="Spring">Spring</option>
                            		<option value="Fall">Fall</option>
                            		<option value="Summer">Summer</option>
                            	</select>
                            </div>
                            <label for="year" style="text-align: right" class="col-md-2 control-label">Year : </label>
                              <div class="col-md-3">
                            	<select id="year" name="year" class="form-control">
                            		<option value="{{date("Y")}}">{{date("Y")}}</option>
                            		@for($i=1;$i<15;$i++)
                            		<option value="{{date("Y")-$i}}">{{date("Y")-$i}}</option>
                            		@endfor
                            	</select>
                            </div>

                            <div class="col-md-1">
                            	<input type="submit" class="btn  btn-primary" value="ADD">
                            </div>
                            <div class="col-md-12">
                            	 @if ($errors->has('semister_name'))
					                <span style="color: red">
					                    <strong>{{ $errors->first('semister_name') }}</strong>
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
          		<th>Semister Name</th>
          		<th>Action</th>
          	</tr>
	         @foreach($data as $value)     
	           	 <tr>
	           	 	<td>{{$i}}</td>
	           	 	<td>{{$value->semister_name}}</td>
	           	 	<td>
	           	 		<form method="post" action="{{route('delete_semister',['id'=>$value->id])}}">{{ csrf_field() }}
	           	 		<input type="submit" class="btn btn-danger" value="Delete">
	           	 		</form>
	           	 	</td>
	           	 </tr>
	           @php $i++; @endphp
	         @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Semister is Empty !!
         </h1>
        @endif
     </div>
  </div>
</div>
</div>
 
@endsection