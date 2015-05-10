@extends('lecturers.master')

@section('head')
<link rel="stylesheet" href="/css/ssignment.css">
@stop

@section('content')

<div class="section-heading">
    @if($assessment->assessment_type == 1)
    <h1 id="heading">Assignment</h1>
    @else
    <h1 id="heading">Test</h1>
    @endif
    <hr/>

</div>

<div class="main-content">
    <div class="row">
        <div class="col-md-8">
            <h2>{{$assessment->course->name}}</h2>
            <h4><em>{{$assessment->title}}</em></h4>
        </div>
        <div class="col-md-4">
            <h4><strong>Created on:</strong> {{ date('F d, Y',strtotime($assessment->start_date)) }}</h4>
            <h4><strong>Due Date:</strong> {{ date('F d, Y',strtotime($assessment->end_date)) }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <p>{{$assessment->description}}</p>
        </div>
        <div class="col-md-6">
            <div class="button pull-right">
                <div class="btn-group">
                    <a href="{{{ route('teachers/assessment/edit',['assessment_id'=>$assessment->id]) }}}"  class="btn btn-success">Edit</a>
                    <a href="{{{ route('teachers/deleteAssessment', ['assessment_id'=>$assessment->id]) }}}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <hr/>
</div>
@stop