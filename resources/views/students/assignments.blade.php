@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/ssignment.css"> 
@stop

@section('content')
   <div class="container">
	<div class="section-heading">
   		<h1 id="heading">Assignments</h1>
   		<hr/>
 	</div>

       @if (Session::has('error'))
       <div class="alert alert-danger">
           <ul>
               <li>{{ Session::get('error') }}</li>
           </ul>
       </div>
       @endif

       @if (Session::has('success'))
       <div class="alert alert-success">
           <ul>
               <li>{{ Session::get('success') }}</li>
           </ul>
       </div>
       @endif
     
    @foreach($assignments as $assignment)
    <a href="{{{ route('students/assessment',['assessment_id'=>$assignment->id]) }}}">
        <div class="main-content">
            <div class="row">
                <div class="col-md-8">
                    <?php $course = $assignment->course;?>
                    <h2>{{$course->name}}</h2>
                    <h4><em>{{$assignment->title}}</em></h4>
                </div>
                <div class="col-md-4">
                    <h4><strong>Due Date:</strong> {{date('F d, Y',strtotime($assignment->end_date) ) }}</h4>
                    <h4><strong>Time:</strong> {{date('H:i',strtotime($assignment->end_date) )}} </h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h4><strong>Description:</strong></h4>
                    <p>
                        {{$assignment->description}}
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="button">
                        <div class="btn-group pull-right">
                            <a href="{{{ route('students/download',['filename'=>$assignment->filepath]) }}}" class="btn btn-primary">Download</a>
                            <a class="btn btn-info" href="{{{ route('students/uploadAssignment',['assessment_id'=>$assignment->id]) }}}">Upload </a>
                            <a href="{{{ route('students/addToQueueView',['assessment_id'=>$assignment->id]) }}}"  class="btn btn-warning">Add to Queue</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
        </div>
    </a> 
    @endforeach

       @if(!$pastAssignments->isEmpty())
           <div class="section-heading">
               <h1 id="heading">Past Assignments</h1>
               <hr/>
           </div>
        @foreach($pastAssignments as $assignment)
           <a href="{{{ route('students/assessment',['assessment_id'=>$assignment->id]) }}}">
               <div class="main-content">
                   <div class="row">
                       <div class="col-md-8">
                           <?php $course = $assignment->course;?>
                           <h2>{{$course->name}}</h2>
                           <h4><em>{{$assignment->title}}</em></h4>
                       </div>
                       <div class="col-md-4">
                           <h4><strong>Due Date:</strong> {{date('F m, Y',strtotime($assignment->end_date) )}}</h4>
                           <h4><strong>Time:</strong> {{date('H:i',strtotime($assignment->end_date) )}} </h4>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-md-6">
                           <h4><strong>Description:</strong></h4>
                           <p>
                               {{$assignment->description}}
                           </p>
                       </div>
                       <div class="col-md-6">
                           <div class="button">
                               <div class="btn-group pull-right">
                                    @if($assignment->filepath != null)
                                        <a href="{{{ route('students/download',['filename'=>$assignment->filepath]) }}}" class="btn btn-primary">Download</a>
                                    @endif
                               </div>
                           </div>
                       </div>
                   </div>
                   <hr/>
               </div>
           </a>
       @endforeach
       @endif
 </div>
 @stop