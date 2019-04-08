  <div class="panel panel-default" >
            <nav id="sidebar">
             <ul class="list-unstyled components">
                <li> <a href="{{url('teacher/home')}}"><i class="fa fa-university "></i> Dashboard</a> </li> 
                <li> <a href="{{url('teacher/course_list')}}"><i class="fa fa-list-ul"></i>  Course List</a> </li> 
                <li> <a href="{{url('teacher/presentation')}}"><i class="fa fa-list-ul"></i>  Presentation
                 <span style="color: red">({{$presentation_red}})</span><span style="color: #3644A9">({{$presentation_panding}})</span>
             </a> </li>  
                <li> <a href="{{url('teacher/assignment')}}"><i class="fa fa-list-ul"></i>  Assignment
                <span style="color: red">({{$assignment_red}})</span><span style="color: #3644A9">({{$assignment_panding }})</span>
            </a> </li>  
                <li> <a href="{{url('teacher/quiz')}}"><i class="fa fa-list-ul"></i>  Quiz
                <span style="color: red">({{$quiz_red}})</span><span style="color: #3644A9">({{$quiz_panding }})</span>
            </a> </li>  
            </ul>
            </nav>
</div>