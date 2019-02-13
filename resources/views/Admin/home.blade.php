@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3" >
           @include('.layouts.admin_side_navbar')
       </div>
       <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Admin</div>
                <div class="panel-body">
                	<h3>Total students : {{$students}}</h3>
		          	<h3>Total courses : {{$courses}}</h3>
		          	<h3>Total departments : {{$departments}}</h3>
                </div>
            </div>

          </div>
    </div>
  </div>
 
@endsection