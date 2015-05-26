@extends('invigilators.master')


@section('content')
 <div class="container text-center">
    <div class="section-heading">
       <h1>Script Collection</h1>
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

    <div class="margin-b-80">
        <h3>
          {{$course->name}}
       </h3>
       <p class="text-muted initialism">
          <strong>Date: </strong> {{ date('F d, Y',strtotime($test->start_date)) }}
          &nbsp &nbsp
          <strong>Start Time:</strong> {{ date('H:i:s',strtotime($test->start_date)) }}
          &nbsp &nbsp
       </p>
    </div>
    
       {!! Form::open(['method'=>'POST','route'=>['invigilators/collectPaper',$test->id], 'class'=>'form-horizontal width-50 center-block margin-b-100']) !!}
        <div class="form-group margin-b-30"> 
            <input type="text" class="form-control" name="user_id" placeholder="Enter Student ID"/>
        </div>      
        <div class="form-group margin-b-30"> 
            <input type="text" class="form-control" name="paper_id" placeholder="Enter ID Number on the TEST paper"/>
        </div>      
        <div class="form-group">
           <button type="submit" class="btn btn-success">
               <i class="fa fa-user-plus"></i>  Add Student                  
         </button> 
         &nbsp &nbsp
         <a href="/invigilators/home" type="button" class="btn btn-danger">
             <i class="fa fa-arrow-left"></i>    End Collection
         </a>
       </div>    

    {!! Form::close() !!}


  
 </div>
@stop


 