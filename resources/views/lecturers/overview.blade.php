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
        <a href="{{ route('teachers/assignments') }}">
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
                                <p class="text-elg text-strong mb-0">{{count($assignments)}}</p> <span class="topic">Assignments active</span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
        </a>
		<!-- /col -->
		<!-- col -->
        <a href="{{ route('teachers/tests') }}">
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
                                <p class="text-elg text-strong mb-0">{{count($tests)}}</p> <span class="topic">Upcoming tests</span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>

                </div>
            </div>
        </a>
		<!-- /col -->
		<!-- col -->
        <a href="{{ route('teachers/submissions') }}">
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
                                <p class="text-elg text-strong mb-0">{{count($submissions)}}</p> <span>Recent Student Submissions </span> </div>
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
                    <h3>Active Assignments</h3>
                    <ul>
                        @foreach($assignments as $assignment)
                            <li><a href="{{ route('teachers/assessment',['assessment_id'=>$assignment->id]) }}">{{$assignment->title}}</a></li>
                        @endforeach
                   </ul>
                  </div>
                  <div class="col-md-4">
                    <h3>Upcoming Tests</h3>
                      <ul>
                          @foreach($tests as $test)
                            <li><a href="{{ route('teachers/assessment',['assessment_id'=>$test->id]) }}">{{$test->title}}</a></li>
                          @endforeach
                    </ul>       
                  </div>
                  <div class="col-md-4">
                  <h3>Recent Submissions by Students</h3>
                    <ul>
                        @foreach($submissions as $submission)
                            <li><a href="{{ route('teachers/submission',['submission_id'=>$submission->id]) }}">{{$submission->assessment->title}}</a></li>
                        @endforeach

                   </ul>               
                </div>         
          </div>
         </div>
      </div>
@stop