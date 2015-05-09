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

        <title>ASAS | Student Services</title>
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
            
          </div><!-- /.container-fluid -->
       </nav>
      
        @yield('content')     
   </body>
    
    <footer>
         <div id="footer">
           <div class="row">
                <div class="col-md-12">
                    <a href="#" id="brand">
                       ASAS
                    </a>
                </div>
           <div>
    </footer>

    <script src="/js/essentials/jquery-2.1.3.min.js"></script>
    <script src="/js/essentials/bootstrap.min.js"></script>
    @yield('scripts')
     
</html>
