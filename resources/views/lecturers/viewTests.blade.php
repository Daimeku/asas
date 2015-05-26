
@extends('lecturers.master')

@section('content')
<div class="section-heading">
	<h1 id="heading">Tests Created </h1>
	<hr/>
 </div>

<!--Ashani:  This view will show all the submissions for each module that the lecturer teaches-->
  <div class="main-content">   
    
      <!--Search Bar-->
      <div class="container search">
           <div class="input-group">
              <div class="input-group-btn search-panel">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                     	<span id="search_concept">Filter by</span> <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Module</a></li>
                    <li><a href="#">Student ID</a></li>
                    <li><a href="#">Test Name</a>
                  </ul>
              </div>
              
              <input id="txtSearch" type="text" class="form-control" placeholder="Search">
              <span class="input-group-btn pull-left">
                  <button class="btn btn-default" type="button"><span class="fa fa-search"></span></button>
              </span>
          </div>
       </div>
        
       <div class="container">
           @foreach($tests as $test)
                <div class="row">
                    <div class="col-md-8">
                      <h2>{{$test->course->name}}</h2>
                      <h4><em><b>test name:</b> {{$test->title}} </em></h4>

                       <div class="btn-group">
                           <a href="{{{ route('teachers/assessment/edit',['assessment_id'=>$test->id]) }}}"  class="btn btn-success">Edit</a>
                           <a href="{{{ route('teachers/deleteAssessment', ['assessment_id'=>$test->id]) }}}" class="btn btn-danger">Delete</a>
                       </div>
                    </div>

                    <div class="col-md-4">
                      <h4><strong>Test Date:</strong> {{ date('F d, Y',strtotime($test->start_date)) }}</h4>

                      <h4><strong>Test Time:</strong> {{ date('H:i',strtotime($test->start_date)) }} </h4>
                        <h4><strong>Description:</strong> {{$test->description}}</h4>
                    </div>
                </div>
                 <hr/>
           @endforeach

           @if(!$pastTests->isEmpty())
           <div class="section-heading">
               <h1 id="heading">Past Tests </h1>
               <hr/>
           </div>
            @foreach($pastTests as $test)
           <div class="row">
               <div class="col-md-8">
                   <h2>{{$test->course->name}}</h2>
                   <h4><em><b>test name:</b> {{$test->title}} </em></h4>

                   <div class="btn-group">
                       <a href="{{{ route('teachers/deleteAssessment', ['assessment_id'=>$test->id]) }}}" class="btn btn-danger">Delete</a>
                   </div>
               </div>

               <div class="col-md-4">
                   <h4><strong>Test Date:</strong> {{ date('F d, Y',strtotime($test->start_date)) }}</h4>

                   <h4><strong>Test Time:</strong> {{ date('H:i',strtotime($test->start_date)) }} </h4>
                   <h4><strong>Description:</strong> {{$test->description}}</h4>
               </div>
           </div>
           <hr/>
            @endforeach
           @endif
        </div>
        
   </div>
 @stop