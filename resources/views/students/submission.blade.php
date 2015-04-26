@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/students/assignment.css">
@stop

@section('content')
	<div class="section-heading">
   		<h1 id="heading">Submissions</h1>
   		<hr/>
 	</div>
 	<div class="main-content">
 		<div class="row">
			<div class="col-md-8">
				<h2>Course Name</h2>
				<h4><em>Assignment Name</em></h4>
			</div>
		  <div class="col-md-4">
  				<h4><strong>Submission Date:</strong> April 10, 2015</h4>
  				<h4><strong>Time:</strong> 3pm </h4>
          <h4 class="grade">Grade: 94%</h4>
			 </div>
 		</div>

		</div>
		<hr/>
 	</div>
 @stop
