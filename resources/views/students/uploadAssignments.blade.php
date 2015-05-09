@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
@stop


@section('content')

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

  <div class="section-heading">
	<h1 id="heading">Upload Assignment</h1>
	<hr/>
 </div>

  <div class="uploadAssignmentContent">
     <div class="container">       

         {!! Form::open([ 'route'=>array('students/upload',$assessment->id ), 'method' => 'POST', 'files' => true, 'class'=>'assignment-form form-horizontal', 'name'=>'upload_assignment']) !!}
         {!! Form::hidden('assessment_id', $assessment->id) !!}
         <!-- textarea for Student IDs and Names -->
        <div class="form-group">         
            <textarea name="user_id"  type="text" placeholder="Enter the Names and ID Numbers of the group members" value="" class="form-control" rows="3"></textarea>
        </div>
        
         <!-- textarea for comment -->
<!--        <div id="uploadAssignment" class="form-group">-->
<!--            <textarea type="text" placeholder="Add a comment here..." value="" class="form-control" rows="2"></textarea>-->
<!--        </div>-->
        
        <div class="form-group">     
            <input type="file" id="exampleInputFile" name="assessment">
<!--            <p class="help-block">Upload your assignment</p>-->
       </div>
       
       <div class="pull-right">
           <i class="fa fa-plus" class="col-green" data-toggle="tooltip" data-placement="left" title="Tooltip on left"></i> &nbsp&nbsp
           <i class="fa fa-minus" class="col-red"></i>
       </div>
       
         <form class="form-inline">
             <div class="form-group">
               <input type="text" name="students[1]" class="form-control width-30" placeholder="Enter a Student ID">
              </div>   
         </form>
        
        <div class="form-group text-center">
            <div class="btn btn-group">
                <input type="submit" value="Send to Lecturer" class="btn btn-primary">
                <input type="submit" value="Send to Lecturer & Student Services" class="btn btn-warning">
            </div>
        </div>
         {!! Form::close() !!}
    </div>
 </div>
 @stop
 
 @section('scripts')
 <scripts>
    $(function () {
      $('[data-toggle="popover"]').popover()
    })
 </scripts>
 @stop
