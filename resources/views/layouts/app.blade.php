<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">

    <title>Diu Notification System</title>
        

    <!-- Styles -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet"> 
    <link href="{{asset('css/app.css')}}" rel="stylesheet"> 
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
     <!-- navigation bar -->
    <nav class="navbar custom-navber">
        <div class="container-fluid">
            <div class="navbar-header"> <a class="navbar-brand" href="{{url('/')}}">DIU Notification System</a> </div>

             <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (session('auth') === true)
                           <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ session('name') }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Login <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('student_login') }}">
                                            Student
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('teacher_login') }}">
                                            Teacher
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin_login') }}">
                                            Admin
                                        </a>
                                    </li>
                                </ul>
                            </li> 
                        @endif
                    </ul>
            
            
        </div>
    </nav>

    @yield('content')
    {{--footer--}}
      <div class="container-fluid" id="footer" style="background-color: #2BAF6C;color: #000000;margin-top: 15px;">
     <div class="row">
        <div class="col-md-12" style="background-color: black;color: white;text-align: center;padding: 10px;">All Rights Reserved @ Daffodil International University</div>
         
     </div>
   </div>
  

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
 
    
   
</body>
</html>
