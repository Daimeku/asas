@extends('invigilators.master')


@section('content')

<div class="container text-center">
     <div class="section-heading">
       <h1>Examination Entry</h1>
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
    <div class="margin-b-80 text-center">
        <h3>
            {{$course->name}} <small>Venue: {{$occurrence->location->location}}</small>
        </h3>
        <p class="text-muted initialism">
            <strong>Date: </strong> {{{  date('F m, d', strtotime($test->start_date)) }}}
            &nbsp &nbsp
            <strong>Start Time:</strong> {{date('H:i',strtotime($test->start_date))}}
            &nbsp &nbsp
        </p>
    </div>

    <div>
        @if( ! Session::has('error'))
        <img src="{{$student->image_file_path}}" scrolling="no" width="255" height="227" align="middle" style="border-color:black;"  marginheight="50" name="Changeable">
        @else
        <img src="{{public_path.'male-silhouette.jpg'}}" scrolling="no" width="255" height="227" align="middle" style="border-color:black;"  marginheight="50" name="Changeable">
        @endif
    </div>

    
     {!! Form::open(['method'=>'POST','route'=>['invigilators/searchStudent',$test->id]]) !!}
     <div class="margin-t-50">         
         <input type="text" class="form-control width-30 margin-b-30 center-block" name="student_id" placeholder="Enter Student ID"/>    
         <div class="text-center">
             <button type="submit" class="btn btn-info">
                   <i class="fa fa-exchange"></i>  Find Student                  
             </button>
             &nbsp &nbsp
             @if($error ===null)

                     <a  class="btn btn-success" href="{{{route('invigilators/enterTest',['test_id'=>$test->id, 'user_id'=>$student->id])}}}"
                       <i class="fa fa-user-plus"></i> Add Student
                      </a>

             @endif
             &nbsp &nbsp
             <a href="{{{ route('invigilators/paperCollection',['assessment_id'=>$test->id]) }}}"  class="btn btn-warning">
                   <i class="fa fa-edit"></i> Collect Scripts                
             </a>
         </div>
     </div>  
     {!! Form::close() !!}
      
     @if($error === null)
        <div class="margin-t-50 center-block alert alert-success width-30">
            <p><i class="fa fa-info-circle"><strong>ID:</strong>{{$student->id}} &nbsp&nbsp<strong>Student: {{$student->name}}</strong></p>
        </div>
    @elseif($error != null)
         <div class="margin-t-50 center-block alert alert-success width-30">
            <p><i class="fa fa-exclamation-circle">{{$error->errorMessage}}</i></p>
        </div>     
    @endif

     
</div>
@stop



