@extends('invigilators.master')


@section('content')

<div class="container text-center">
     <div class="section-heading">
       <h1>Examination Entry</h1>
       <hr/>
    </div>
    <div class="margin-b-80 text-center">
        <h3>
         {{$course->name}} <small>Venue: 2B7</small>
       </h3>
       <p class="text-muted initialism">
          <strong>Date: </strong> {{{$test->start_date}}} 
          &nbsp &nbsp
          <strong>Start Time:</strong> 2pm
          &nbsp &nbsp
          <strong>End Time:</strong> 3pm
       </p>            
    </div>   
    
    @if($error === null)
    <div>
        <img src="" scrolling="no" width="255" height="227" align="middle" style="border-color:black;"  marginheight="50" name="Changeable">
    </div>
    @endif
    
     {!! Form::open(['method'=>'POST','route'=>['invigilators/searchStudent',$test->id]]) !!}
     <div class="margin-t-50">         
         <input type="text" class="form-control width-30 margin-b-30 center-block" name="student_id" placeholder="Enter Student ID"/>    
         <div class="text-center">
             <button type="submit" class="btn btn-info">
                   <i class="fa fa-exchange"></i>  Find Student                  
             </button>
             &nbsp &nbsp

             &nbsp &nbsp
             <button type="submit" class="btn btn-warning">
                   <i class="fa fa-edit"></i> Collect Scripts                
             </button>
         </div>
     </div>  
     {!! Form::close() !!}
      
     @if($error === null)

    @elseif($error != null)
         <div class="margin-t-50 center-block alert alert-success width-30">
            <p><i class="fa fa-exclamation-circle"></i>{{$error->errorMessage}}</strong></p>
        </div>     
    @endif

     
</div>
@stop



