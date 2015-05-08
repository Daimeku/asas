@extends('invigilators.master')


@section('content')
 <div class="container text-center">
    <div class="section-heading">
       <h1>Script Collection</h1>
       <hr/>
    </div>
    <div class="margin-b-80">
        <h3>
          {{$course->name}} <small>Mr. Tyrone Edwards </small>
       </h3>
       <p class="text-muted initialism">
          <strong>Date: </strong> {{ date('F d, Y',strtotime($test->start_date)) }}
          &nbsp &nbsp
          <strong>Start Time:</strong> {{ date('H:i:s',strtotime($test->start_date)) }}
          &nbsp &nbsp
          <strong>End Time:</strong> 3pm
       </p>            
    </div>
    
    <form class="form-horizontal width-50 center-block margin-b-100">
       {!! Form::open(['method'=>'POST','route'=>['invigilators/collectPaper',$test->id]]) !!}
        <div class="form-group margin-b-30"> 
            <input type="text" class="form-control" name="user_id" placeholder="Enter Student ID"/>
        </div>      
        <div class="form-group margin-b-30"> 
            <input type="text" class="form-control" name="paper_id" placeholder="Enter ID Number on the TEST paper"/>
        </div>      
        <div class="pull-right">
           <button type="submit" class="btn btn-success">
               <i class="fa fa-user-plus"></i>  Add Student                  
         </button> 
         &nbsp &nbsp
         <button type="button" class="btn btn-danger">
             <i class="fa fa-arrow-left"></i>    End Collection
         </button> 
       </div>    
    {!! Form::submit('verify') !!}
    {!! Form::close() !!}
   </form> 
    
 
   @if($message !=null)
    <div class="center-block alert alert-success width-30 margin-t-50">
        <p><i class="fa fa-info-circle"></i>&nbsp &nbsp {{$message}}</p>
    </div>
  @endif
  
 </div>
@stop


 