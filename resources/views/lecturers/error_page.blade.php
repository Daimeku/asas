@extends('lecturers.master')

@section('content')
	<div class="section-heading">
   		<h1 id="heading">Oops! An error occured</h1>
   		<hr/>
 	</div>
   
   <div class="main-content">	  
     <div class="row">
        <div class="col-md-4 pull-left">
           <img src="/img/error.jpg" alt="Unfortunately an error occured">  
        </div>
       
        <div class="col-md-offset-6 uploadAssignmentContent">
              <div class="animated bounceIn">            
                <ul class="text-danger err">
                  <li>Example of Error #1</li>
                  <li>Example of Error #2</li>
                </ul>
             </div>
        </div>
	 </div>
   </div>    
@stop