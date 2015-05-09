@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
@stop


@section('content')
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

  <div class="container">  
       <div class="section-heading">
    	 <h1>Upload Assignment</h1>
    	 <hr/>
       </div>
    
      <form class="form-horizontal">
         {!! Form::open([ 'route'=>array('students/upload',$assessment->id ), 'method' => 'POST', 'files' => true, 'class'=>'assignment-form form-horizontal', 'name'=>'upload_assignment']) !!}
         {!! Form::hidden('assessment_id', $assessment->id) !!}     
         
         <div class="form-group text-center margin-b-30">
            <div class="radio">
              <label>
                <input type="radio" name="blankRadio" id="rbGroup"  value="option1" checked>  Group Work
              </label>
              &nbsp&nbsp
              <label>
                <input type="radio" name="blankRadio" id="rbSingle" value="option2">  Individual Work
              </label>
             </div>
          </div>             
       </form> 
       <form class="form-inline text-center">
           <div id="txtGroup" class="form-group">
             <input type="text" name="students[1]" class="form-control width-50" placeholder="Member's ID Number">
             <input type="text" name="students[2]" class="form-control width-50" placeholder="Member's ID Number">
          </div>
       </form>
        
        <button id="addButton" class="x">Add Button</button>
        {!! Form::close() !!}            
     
  </div>
 @stop
 
 @section('scripts')
<script type="text/javascript">
  
     console.log("hi");
          
      $("#addButton").click(function() {
        console.log("entered");
      });

</script>
 @stop
