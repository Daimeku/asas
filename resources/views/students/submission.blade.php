@extends('students.master')

@section('head')
<link rel="stylesheet" href="/css/students/assignment.css">
@stop

@section('content')
 <div class="container">
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
                <h4><strong>Submission Date:</strong> {{ date('F d, Y',strtotime($submission->time)) }} </h4>
                <h4><strong>Time:</strong> {{ date('H:i',strtotime($submission->time)) }}</h4>
                <h4 ><strong>Submitted by:</strong> </h4>
                <ul>
                    @foreach($submission->users as $student)
                        <li>{{$student->name}}</li>
                    @endforeach
                </ul>
            </div>
        </div>    
    </div>
    <hr/>
</div>

@stop
