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

        <title>ASAS | Student</title>
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
              <a class="navbar-brand" href="#">ASAS</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="#"><i class="fa fa-tasks"></i>     Assignments</a></li>
                <li><a href="#"><i class="fa fa-upload"></i>     Submissions</a></li>
                <li><a href="#"><i class="fa fa-file-text"></i>     Tests</a></li>              
              </ul>
              <ul class="nav navbar-nav navbar-right">
                 <li><a href="#">Sign Out</a></li>                          
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
                      <li><a href="#">Course 1</a></li>
                      <li><a href="#">Course 2</a></li>
                      <li><a href="#">Course 3</a></li>
                      <li><a href="#">Course 4</a></li>
                   </ul>                 
                  </div>
                  <div class="col-md-3">
                    <h4>Past Tests <h4>
                      <ul>
                        <li><a href="#">Test 1</a></li>
                        <li><a href="#">Test 2</a></li>
                        <li><a href="#">Test 3</a></li>
                        <li><a href="#">Test 4</a></li>
                    </ul>       
                  </div>
                  <div class="col-md-3">
                  <h4>Recent Receipts<h4>
                    <ul>
                      <li><a href="#">Receipt 1</a></li>
                      <li><a href="#">Receipt 2</a></li>
                      <li><a href="#">Receipt 3</a></li>
                      <li><a href="#">Receipt 4</a></li>
                   </ul>
                   </div>
                </div>
            </div>          
      </div>
    </footer>
    
    <script src="/js/essentials/jquery-2.1.3.min.js"></script>
    <script src="/js/essentials/bootstrap.min.js"></script>
</html>