@extends('lecturers.master')

@section('head')
 <link rel="stylesheet" href="/css/ssignment.css"> 
@stop

@section('content')
	<div class="section-heading">
   		<h1 id="heading">Assignments Created</h1>
   		<hr/>
 	</div>
    <div class="main-content">
        <div class="row">
            <div class="col-md-8">                   
                <h2>Course Name</h2>
                <h4><em>Assignment Name</em></h4>               
            </div>
            <div class="col-md-4">
                <h4><strong>Created on:</strong>  June 24, 2015</h4>
                <h4><strong>Due Date:</strong> May 1, 2015</h4>
                <h4><strong>Time:</strong> 3pm </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
               <p>Hi there, I am a description</p>
            </div>
            <div class="col-md-6">
                <div class="button pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-success">Edit</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
    </div>

 @stop