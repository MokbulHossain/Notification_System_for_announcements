@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
       	<div id="add_department" class="col-md-12">
       		<form action="{{route('add_section')}}" method="post">
       			  {{ csrf_field() }}

       			  <div class="form-group">
                            <label for="campus" class="col-md-2 control-label" style="text-align: right">Campus Name : </label>

                            <div class="col-md-3" class="form-control">
                            	<select id="campus" name="campus" class="form-control">
                            		<option value="MC">MC</option>
                            		<option value="PC">PC</option>
                            	</select>
                            </div>
                            <label for="section" style="text-align: right" class="col-md-2 control-label">Section Name : </label>
                              <div class="col-md-3">
                            	<select id="section" name="section" class="form-control">
                            		@for($char = 'A'; $char <= 'Z'; $char++)
                            		<option value="{{$char}}">{{$char}}</option>
                            		@endfor
                            	</select>
                            </div>

                            <div class="col-md-1">
                            	<input type="submit" class="btn  btn-primary" value="ADD">
                            </div>
                            <div class="col-md-12">
                            	 @if ($errors->has('section_name'))
					                <span style="color: red">
					                    <strong>{{ $errors->first('section_name') }}</strong>
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
          		<th>Section Name</th>
          		<th>Action</th>
          	</tr>
	         @foreach($data as $value)     
	           	 <tr>
	           	 	<td>{{$i}}</td>
	           	 	<td>{{$value->section_name}}</td>
	           	 	<td>
	           	 		<form method="post" action="{{route('delete_section',['id'=>$value->id])}}">{{ csrf_field() }}
	           	 		<input type="submit" class="btn btn-danger" value="Delete">
	           	 		</form>
	           	 	</td>
	           	 </tr>
	           @php $i++; @endphp
	         @endforeach
         </table>
         @else <h1 style="text-align: center;color: red;">Section is Empty !!
         </h1>
        @endif
     </div>
  </div>
</div>
</div>
 
@endsection