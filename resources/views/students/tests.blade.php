@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
@stop

@section('content')
   <div class="container">
	<div class="section-heading">
   		<h1 id="heading">Tests</h1>
   		<hr/>
 	</div>

        @foreach($tests as $test)
        <div class="main-content">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{$test->course->name}}</h2>
                </div>
                <div class="col-md-4">
                    <h4><strong>Test Date:</strong> {{ date('F d, Y',strtotime($test->start_date)) }}</h4>
                    <h4><strong>Time:</strong> {{ date('H:i',strtotime($test->start_date)) }} </h4>
<!--              <h4><strong>Classroom:</strong> LT-2B1 </h4>-->
                </div>
            </div>
       </div>
        <hr/>       
        @endforeach
          
     </div>
  
 @stop
