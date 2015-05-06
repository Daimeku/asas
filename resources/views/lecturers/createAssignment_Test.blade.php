
@extends('lecturers.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
 <link rel="stylesheet" href="/css/jQueryUI/jquery-ui.min.css">
@stop




@section('content')

  <div class="section-heading">
   		<h1 id="heading">Create Assignment / Test </h1>
   		<hr/>
 </div>

  <div class="main-content">
     <div class="container">
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



         <!--      <form name="assignment_test" class="assignment-form form-horizontal">-->
        <!--<form class="form-horizontal" action="teachers/createAssignment" method="POST">-->
        {!! Form::open(['route'=>'teachers/create', 'method' => 'POST', 'files'=>true, 'class'=>"assignment-form form-horizontal",'name'=>"assignment_test" ]) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="assessment_type" value="1">
              
        <div class="form-group toggle-btn pull-right">
            <button type="button" id="btnAssignment" class="btn btn-primary  btn-highlight"> Assignment</button>
            <button type="button" id="btnTest" class="btn btn-primary"> Test </button>      
         </div>
        
        <!-- Assignment Name -->
        <div class="form-group">          
           <input id="title" name="title" type="text" placeholder="Enter Assignment or Test name" value="{{{Input::old('title')}}}" class="form-control">      
       </div>

      <!-- Description -->         
        <div class="form-group">         
            <textarea id="description" name="description" type="text" placeholder="Enter the Assignment or Test Description here" value="{{{Input::old('description')}}}" class="form-control" rows="3"></textarea>
        </div>
        
         <!--Upload-->
        <div id="uploadAssignment" class="form-group">
             <div class= "row">
                 <div class="col-md-8 removeLeftPadding">                    
<!--                    <input id="uploadTxt" name="upload" type="text" placeholder="Upload Assginment" value="" class="form-control">-->
                     {!! Form::file('assessment',['class'=>"form-control"]) !!}
                 </div>
                 <div class="col-md-4"> 
                     <input id="btnUpload" type="button" value="Browse" class="btn btn-md btn-primary">        
                 </div>
             </div> 
         </div>
  
        <!--Classroom + Time -->
        <div id="testInfo" class="form-group hidden">
             <div class= "row">
                 <div class="col-md-7 removeLeftPadding">                    
                    <input id="txtTestVenue" name="upload" type="text" placeholder="Test Venue" value="" class="form-control">   
                 </div>
                 <div class="col-md-5"> 
                    <input id="txtTestTime" name="upload" type="text" placeholder="Test Time" value="" class="form-control">    
                 </div>
             </div> 
         </div>
         
        <!-- Start Date -->        
        <div class="form-group">        
           <input id="start_date" name="start_date" type="text" placeholder="Click to Select Start Date" value = "{{{Input::old('start_date')}}}" class="form-control">
       </div>
    
        <!-- End Date -->
        <div class="form-group">         
              <input id="end_date" name="end_date" type="text" placeholder="Click to Select due date" value="{{{Input::old('end_date')}}}" class="form-control">               
        </div>


        <!-- Course-->
        <div class="form-group">
            <!--<input id="course_id" name="course_id" type="text" placeholder="placeholder"  value="{{{Input::old('course_id')}}}" class="input-xlarge">-->
            <select id="course_id" name="course_id" value="{{{Input::old('assessment_type')}}}" class="form-control select">
                <option>Select a course</option>
                @foreach($courses as $course)
                <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>             
        </div>

        <div class="form-group text-center">
            <input type="submit" value="Create" class="btn btn-lg btn-primary mid btn-padding">
        </div>
             
        {!! Form::close() !!}

     </div>
   </div>
 @stop
 
 @section("scripts")
<script src="/js/jQueryUI/jquery-ui.min.js"></script>
 
 <script>
     $(function() {
        $("#start_date").datepicker();
        $("#end_date" ).datepicker();
        
         $("#btnTest").click( function(){
             $("#assessment_type").val(2);

             $("#btnTest").addClass("btn-highlight");
               $("#btnAssignment").removeClass("btn-highlight");
               
               $("#testInfo").removeClass("hidden");
               $("#end_date").addClass("hidden");
               $("#uploadAssignment").addClass("hidden");
         });
         
          $("#btnAssignment").click( function(){
              $("#assessment_type").val(1);
               $("#btnTest").removeClass("btn-highlight");
               $("#btnAssignment").addClass("btn-highlight");
               
               $("#testInfo").addClass("hidden");
               $("#end_date").removeClass("hidden");
               $("#uploadAssignment").removeClass("hidden");
         });
        
      }); 
</script>
 @stop

