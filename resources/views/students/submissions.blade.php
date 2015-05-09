@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
@stop

@section('content')
  <div class="container">
        <div class="section-heading">
            <h1 id="heading">Submissions</h1>
            <hr/>
        </div>
       
        @foreach($submissionGroups as $group)
        <a href="{{{ route('students/submission',['submission_id'=>$group['submission']->id]) }}}">
            <div class="main-content">
                <div class="row">
                    <div class="col-md-8">
                        <h2>{{$group['course']->name}}</h2>
                        <h4><em>{{$group['assessment']->title}}</em></h4>
                    </div>
                    <div class="col-md-4">
                        <h4><strong>Submission Date:</strong> {{ date('F d, Y',strtotime($group['submission']->time)) }} </h4>
                        <h4><strong>Time:</strong> {{ date('H:i',strtotime($group['submission']->time)) }}</h4>
                   </div>
                </div>

            </div>
            <hr/>           
        </a>
        @endforeach
   </div>
 @stop
