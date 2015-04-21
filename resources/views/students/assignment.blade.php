@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/students/assignment.css"> 
@stop

@section('content')
	<div class="section-heading">
   		<h1 id="heading">Assignments</h1>
   		<hr/>
 	</div>
 	<div class="main-content">
 		<div class="row">
			<div class="col-md-8">
				<h2>Course Name</h2>  
				<h4><em>Assignment Name</em></h4>
			</div>
		    <div class="col-md-4">
				<h4><strong>Due Date:</strong> April 10, 2015</h4>
				<h4><strong>Time:</strong> 3pm </h4> 
			</div>
 		</div> 
 		
 		<div class="row">
			<div class="col-md-6">
				<h4><strong>Description:</strong></h4>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce cursus nunc in hendrerit mattis.
				    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed consequat maximus ornare.
				</p>
			</div>
			<div class="col-md-6">	
				<div class="button">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary">Download</button>
						<button type="button" class="btn btn-info">Upload</button> 
						<button type="button" class="btn btn-success">Send</button> 
						<button type="button" class="btn btn-warning">Add to Queue</button>
					</div>
				</div>
			</div>	
		</div>
		<hr/>
 	</div>
 @stop