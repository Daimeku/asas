<!DOCTYPE html>
<html lang="en">
    
    <head>
        <!-- metadata info. -->
        <meta charset="UTF-8">
        <meta name="application-name" content="ASAS">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="ASAS,UTECH,Assignment Submission and Attendance System,University of Technology, Jamaica">
        <meta name="description" content="Assignment Submission & Attendance System (ASAS) is a prototype online submission and
                                          test attendance validation system for the University of Technology, Jamaica.">
        <!-- stylesheets -->
        <link rel="stylesheet" href="/css/animate.css">
        <link rel="stylesheet" href="/css/icons/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="/css/master.css">
        @yield('head')

        <title>ASAS | Lecturer</title>
    </head>

    <body>
    <nav class="navbar navbar-default">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand animated flip" href="/">ASAS</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="animated fa fa-leanpub"></i>&nbsp&nbsp Assignments <b class="caret"></b>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('teachers/uploadAssignment') }}">Create Assignments</a></li>

                    <li><a href="{{ route('teachers/assignments') }}">View Assignments</a></li>
                  </ul>
                </li>              
                 <li class="dropdown">
                   <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                     <i class="fa fa-file-zip-o"></i>&nbsp&nbsp Tests <b class="caret"></b>
                   </a>
                   <ul class="dropdown-menu" role="menu">
                       <li><a href="{{ route('teachers/uploadAssignment') }}">Create Test Instance</a></li>
                       <li><a href="{{ route('teachers/tests') }}">View Created Tests</a></li>
                   </ul>
                </li>        
                <li><a href="{{ route('teachers/submissions') }}"><i class="fa fa-pencil-square-o"></i>&nbsp&nbsp Submissions</a></li>
              </ul>
              
              <ul class="nav navbar-nav navbar-right">                 
                 <li><a href="/auth/logout"> <i class="fa fa-sign-out"></i>&nbsp&nbsp Sign Out</a></li>
            </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
       </nav>

        <div class="container">
           @yield('content')
        </div>


    </body>
    <footer>
         <div id="footer">
           <div class="row">
                <div class="col-md-3"><a href="#" id="brand">ASAS</a></div>
                 <div class="hidden-sm hidden-xs">
                  <div class="col-md-3">
                    <h4>My Courses<h4>
                    <ul>
                        @if(!$footerData['courses']->isEmpty())
                            @foreach($footerData['courses'] as $course)
                                <li>{{$course->name}}</li>
                            @endforeach
                        @endif

                   </ul>
                  </div>
                  <div class="col-md-3">
                    <h4>Assignments <h4>
                      <ul>
                          @if(!$footerData['assignments']->isEmpty())

                              @foreach($footerData['assignments'] as $assignment)
                                <li ><a href="{{{ route('teachers/assessment',['assessment_id'=>$assignment->id]) }}}">{{$assignment->title}}</a></li>
                              @endforeach
                          @endif

                    </ul>
                  </div>
                  <div class="col-md-3">
                  <h4>Upcoming Tests<h4>
                    <ul>
                        @if(!$footerData['tests']->isEmpty())

                            @foreach($footerData['tests'] as $test)
                            <li "> <a href="{{{ route('teachers/assessment',['assessment_id'=>$test->id]) }}}">{{$test->title}}</a></li>
                            @endforeach
                        @endif
                   </ul>
                   </div>
                </div>
            </div>
      </div>
    </footer>

    <script src="/js/essentials/jquery-2.1.3.min.js"></script>
    <script src="/js/essentials/bootstrap.min.js"></script>
    <script src="/js/others/master.js"></script>
    @yield('scripts')
     
</html>
