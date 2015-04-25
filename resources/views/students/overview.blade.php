@extends('students.master')

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
		                    <p class="text-elg text-strong mb-0">4</p> <span class="topic">Assignments Due</span> </div>
		                <!-- /col -->
		            </div>
		            <!-- /row -->
		        </div>		        
		    </div>
		</div>
		<!-- /col -->
		<!-- col -->
		<div class="card-container col-lg-4 col-sm-6 col-sm-12">
		    <div class="card">
		        <div class="front bg-lightred">
		            <!-- row -->
		            <div class="row">
		                <!-- col -->
		                <div class="col-xs-4"> <i class="fa fa-clock-o fa-4x"></i> </div>
		                <!-- /col -->
		                <!-- col -->
		                <div class="col-xs-8">
		                    <p class="text-elg text-strong mb-0">2</p> <span class="topic">Upcoming Tests</span> </div>
		                <!-- /col -->
		            </div>
		            <!-- /row -->
		        </div>

		    </div>
		</div>
		<!-- /col -->
		<!-- col -->
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
		                    <p class="text-elg text-strong mb-0">5</p> <span>Submissions in 30 days</span> </div>
		                <!-- /col -->
		            </div>
		            <!-- /row -->
		        </div>
		    </div>
		</div>
<!-- /col -->
</div>

<div class="container">   
		<div id="notes">   
           <div class="row">                              
                  <div class="col-md-4">
                    <h3>Assignments Due</h3>
                    <ul>
                        @foreach($assignments as $assignment)
                            <li><a href="#">{{$assignment->title}}</a></li>
                        @endforeach

                   </ul>                 
                  </div>
                  <div class="col-md-4">
                    <h3>Upcoming Tests</h3>
                      <ul>
                        <li><a href="#">Test 1</a></li>
                        <li><a href="#">Test 2</a></li>
                    </ul>       
                  </div>
                  <div class="col-md-4">
                  <h3>Past Submissions</h3>
                    <ul>
                      <li><a href="#">Assign. #1</a></li>
                      <li><a href="#">Assign. #2</a></li>
                      <li><a href="#">Assign. #3</a></li>
                      <li><a href="#">Assign. #4</a></li>
                      <li><a href="#">Assign. #5</a></li>
                   </ul>               
                </div>         
          </div>
         </div>
      </div>
@stop