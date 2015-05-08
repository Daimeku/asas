@extends('lecturers.master')

@section('head')
 <link rel="stylesheet" href="/css/students/assignment.css">
 <link rel="stylesheet" href="/css/jQueryUI/jquery-ui.min.css">
@stop



@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@section('content')

  <div class="section-heading">
   		<h1>Create Assignment or Test </h1>
   		<hr/>
 </div>

  <div class="main-content">
     <div class="container"> 
     
<!--      <form class="assignment-form form-horizontal">-->
        <!--<form class="form-horizontal" action="teachers/createAssignment" method="POST">-->
        {!! Form::open(['route'=>'teachers/create', 'method' => 'POST', 'class'=>'assignment-form form-horizontal']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        
        <!-- Assignment Name -->
        <div class="form-group">          
           <input id="title" name="title" type="text" placeholder="Enter Assignment or Test name" value="{{{Input::old('title')}}}" class="form-control">
       </div>

      <!-- Description -->         
        <div class="form-group">         
            <textarea id="description" name="description" type="text" placeholder="Enter the Assignment or Test Description here" value="{{{Input::old('description')}}}" class="form-control" rows="3"></textarea>
        </div>

        <!-- Start Date -->        
        <div class="form-group">        
           <input id="start_date" name="start_date" type="text" placeholder="Click to Select Start Date" value = "{{{Input::old('start_date')}}}" class="form-control">
       </div>
    
        <!-- End Date -->
        <div class="form-group">         
                <input id="end_date" name="end_date" type="text" placeholder="Click to select date" value="{{{Input::old('end_date')}}}" class="form-control">               
            </div>
        </div>
    
        <!-- Assignment Type-->
        <div class="form-group">      
            <!--<input id="assessment_type" name="assessment_type" type="text" placeholder="placeholder" value="{{{Input::old('assessment_type')}}}" class="input-xlarge"><--></-->
            <div class="radio">
                <label>
                    <input type="radio"  id="rbAssignment" value="assignment" checked> Assignment &nbsp &nbsp
                </label>
                <label>
                    <input type="radio" id="rbTest" value="test"> Test
                </label>
             </div>           
        </div>

        <!-- Course-->
        <div class="form-group">
            <!--<input id="course_id" name="course_id" type="text" placeholder="placeholder"  value="{{{Input::old('course_id')}}}" class="input-xlarge">-->
            <select id="course_id" name="course_id" value="{{{Input::old('assessment_type')}}}" class="form-control select">
                <option>Select a Course</option>
            </select>             
        </div>

        <div class="form-group text-center">
            <input type="submit" value="Create" class="form-control btn btn-lg btn-primary">

        </div>
             
        {!! Form::close() !!}

     </div>
   </div>
 @stop
 
 @section("scripts")
<script src="/js/jQueryUI/jquery-ui.min.js"></script>
 
 <script>
     $(function() {
        $("#start_date" ).datepicker();
        $("#end_date" ).datepicker();
      }); 
</script>
 @stop

