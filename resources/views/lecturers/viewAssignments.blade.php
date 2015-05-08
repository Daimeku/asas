@extends('lecturers.master')

@section('head')
 <link rel="stylesheet" href="/css/ssignment.css"> 
@stop

@section('content')
	<div class="section-heading">
   		<h1 id="heading">Assignments Created</h1>
   		<hr/>
 	</div>
    @foreach($assignments as $assignment)
    <div class="main-content">
        <div class="row">
            <div class="col-md-8">                   
                <h2>{{$assignment->course->name}}</h2>
                <h4><em>{{$assignment->title}}</em></h4>
            </div>
            <div class="col-md-4">
                <h4><strong>Created on:</strong> {{ date('F d, Y',strtotime($assignment->start_date)) }}</h4>
                <h4><strong>Due Date:</strong> {{ date('F d, Y',strtotime($assignment->end_date)) }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
               <p>{{$assignment->description}}</p>
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


    @endforeach

    <div class="section-heading">
        <h1 id="heading">Past Assignments</h1>
        <hr/>
    </div>

    @foreach($pastAssignments as $assignment)
    <div class="main-content">
        <div class="row">
            <div class="col-md-8">
                <h2>{{$assignment->course->name}}</h2>
                <h4><em>{{$assignment->title}}</em></h4>
            </div>
            <div class="col-md-4">
                <h4><strong>Created on:</strong> {{ date('F d, Y',strtotime($assignment->start_date)) }}</h4>
                <h4><strong>Due Date:</strong> {{ date('F d, Y',strtotime($assignment->end_date)) }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p>{{$assignment->description}}</p>
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


@endforeach


 @stop