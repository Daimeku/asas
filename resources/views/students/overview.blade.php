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
        <a href="{{{route('students/assignments') }}}">
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
                                <p class="text-elg text-strong mb-0">{{count($assignments)}}</p> <span class="topic">Assignments Due</span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>
                </div>
            </div>
        </a>
		<!-- /col -->
		<!-- col -->
        <a href="{{{route('students/tests') }}}">
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
                                <p class="text-elg text-strong mb-0">{{count($tests)}}</p> <span class="topic">Upcoming Tests</span> </div>
                            <!-- /col -->
                        </div>
                        <!-- /row -->
                    </div>

                </div>
            </div>
        </a>
		<!-- /col -->
		<!-- col -->
        <a href="{{{route('students/submissions') }}}">
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
                                <p class="text-elg text-strong mb-0">{{count($submissions)}}</p> <span>Recent Submissions </span> </div>
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
                    <h3>Assignments Due</h3>
                    <ul>
                        @foreach($assignments as $assignment)
                            <li><a href="{{{ route('students/assessment', ['assessment_id'=>$assignment->id]) }}}">{{$assignment->title}}</a></li>
                        @endforeach

                   </ul>
                  </div>
                  <div class="col-md-4">
                    <h3>Upcoming Tests</h3>
                      <ul>
                          @foreach($tests as $test)
                          <li><a href="{{{ route('students/tests') }}}">{{$test->title}}</a></li>

                          @endforeach
                    </ul>       
                  </div>
                  <div class="col-md-4">
                  <h3>Recent Submissions</h3>
                    <ul>
                        @foreach($submissions as $submission)
                            <?php $assessment = $submission->assessment ?>
                            <li><a href="{{{ route('students/submission',['submission_id'=>$submission->id]) }}}">{{$assessment->title}}</a></li>

                        @endforeach

                   </ul>               
                </div>         
          </div>
         </div>
      </div>
@stop