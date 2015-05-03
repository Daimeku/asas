@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/students/assignment.css">
@stop

@section('content')
        <div class="section-heading">
            <h1 id="heading">Submissions</h1>
            <hr/>
        </div>
    @foreach($submissionGroups as $group)
        <div class="main-content">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{$group['course']->name}}</h2>
                    <h4><em>{{$group['assessment']->title}}</em></h4>
                </div>
              <div class="col-md-4">
                    <h4><strong>Submission Date:</strong>{{$group['submission']->time}} </h4>
                    <h4><strong>Time:</strong> {{$group['submission']->time}}</h4>
              <h4 class="grade">Grade: </h4>
                 </div>
            </div>

            </div>
            <hr/>
        </div>
    @endforeach
 @stop
