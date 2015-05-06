@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
@stop


@section('content')
  <div class="section-heading">
   		<h1 id="heading">Upload Assignment</h1>
   		<hr/>
 </div>

  <div class="uploadAssignmentContent">
     <div class="container">       

      <form name="upload_assignment" class="assignment-form form-horizontal">
  
         <!-- textarea for Student IDs and Names -->         
        <div class="form-group">         
            <textarea  type="text" placeholder="Enter the Names and ID Numbers of the group members" value="" class="form-control" rows="3"></textarea>
        </div>
        
         <!-- textarea for comment -->
        <div id="uploadAssignment" class="form-group">
            <textarea type="text" placeholder="Add a comment here..." value="" class="form-control" rows="2"></textarea>
        </div>
        
        <div class="form-group">     
            <input type="file" id="exampleInputFile">
            <p class="help-block">Upload your assignment</p>
      </div>
        
        <div class="form-group text-center">
            <div class="btn btn-group">
                <input type="submit" value="Send to Lecturer" class="btn btn-primary">
                <input type="submit" value="Send to Lecturer & Student Services" class="btn btn-warning">
            </div>
        </div>
     </form>
    </div>
 </div>
 @stop
