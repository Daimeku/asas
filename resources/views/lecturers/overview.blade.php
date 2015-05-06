@extends('lecturers.master')

@section('head')
 <link rel="stylesheet" href="/css/students/student.css"> 
@stop

@section('content')
	<div class="section-heading">
   		<h1 id="heading">Overview</h1>
   		<hr/>
 	</div>

 	<div class="row">
		<!-- col -->
        <a href="#">
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-greensea">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4"> <i class="fa fa-users fa-4x"></i> </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">4</p> <span class="topic">Assignments Issued</span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
        </a>
		<!-- /col -->
		<!-- col -->
        <a href="#">
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-lightred">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4"> <i class="fa fa-file-o fa-4x"></i> </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">3</p> <span class="topic">Tests Created</span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>

                </div>
            </div>
        </a>
		<!-- /col -->
		<!-- col -->
        <a href="#">
            <div class="card-container col-lg-4 col-sm-6 col-sm-12">
                <div class="card">
                    <div class="front bg-slategray">
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-xs-4"> <i class="fa fa-eye fa-4x"></i> </div>
                            <!-- /col -->
                            <!-- col -->
                            <div class="col-xs-8">
                                <p class="text-elg text-strong mb-0">23</p> <span>Recent Submissions </span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
        </a>
<!-- /col -->
</div>

<div class="container">   
		<div id="notes">   
           <div class="row">                              
                  <div class="col-md-4">
                    <h3>Assignments Issued</h3>
                    <ul>
                       <li><a href="#">Assignment #1</a></li>
                       <li><a href="#">Assignment #2</a></li>
                       <li><a href="#">Assignment #3</a></li>
                       <li><a href="#">Assignment #4</a></li>
                       <li><a href="#">Assignment #5</a></li>
                   </ul>
                  </div>
                  <div class="col-md-4">
                    <h3>Tests Created</h3>
                      <ul>
                         <li><a href="#">Test #1</a></li>
                         <li><a href="#">Test #2</a></li>
                         <li><a href="#">Test #3</a></li>
                         <li><a href="#">Test #4</a></li>
                         <li><a href="#">Test #5</a></li>
                    </ul>       
                  </div>
                  <div class="col-md-4">
                  <h3>Recent Submissions by Students</h3>
                    <ul>
                        <li><a href="#">Submission #1</a></li>
                        <li><a href="#">Submission #2</a></li>
                        <li><a href="#">Submission #3</a></li>
                        <li><a href="#">Submission #4</a></li>
                        <li><a href="#">Submission #5</a></li>
                   </ul>               
                </div>         
          </div>
         </div>
      </div>
@stop