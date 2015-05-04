@extends('students.master')

@section('head')
<link rel="stylesheet" href="/css/students/assignment.css">
@stop

@section('content')
<div class="section-heading">
    <h1 id="heading">Submission</h1>
    <hr/>
</div>

<div class="main-content">
    <div class="row">
        <div class="col-md-8">
            <h2>{{$course->name}}</h2>
            <h4><em>{{$assessment->title}}</em></h4>
        </div>
        <div class="col-md-4">
            <h4><strong>Submission Date:</strong>{{$submission->time}} </h4>
            <h4><strong>Time:</strong> {{$submission->time}}</h4>
            <h4 class="grade">Grade: </h4>
        </div>
    </div>

</div>
<hr/>
</div>

@stop
