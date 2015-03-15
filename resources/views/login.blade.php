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
        <link rel="stylesheet" href="/css/login/login.css">
    </head>
    
    <body>
        <header>
            <nav class="nav navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">                    
                        <a id="nav-brand" class="navbar-brand" href="#">ASAS</a>                       
                    </div> 
                     <span id="full-brand" class="brand-display">Assignment Submission & Attendance System</span>
                </div>
            </nav>         
        </header>
          <div class="jumbotron">       
              <div class="container-fluid">               
                     <div class="icon">
                       <i class="fa fa-cloud-upload hidden-xs hidden-sm animated pulse infinite"></i>
                     </div>
                     <div id="login-form">       
                          <h4 id=signIn>Sign in</h4> 
                         <input id="txtUsername" type="text" class="no-error" placeholder="Id Number">  
                         <input id="txtPassword" type="password" class="no-error" placeholder="Password">                               
                         <button id="#btnLogin" type="button" class="btn btn-default">Login</button>
                    </div>
                </div>
               <div class="container">
                    <div class="login-footer">
                        <a href="#">Password Policy</a>                   
                    </div>      
                </div>
              </div>              
     </body>
    
    <script src="/js/essentials/jquery-2.1.3.min.js"></script>
    <script src="/js/others/login.js"></script>
</html>