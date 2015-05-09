@extends('students.master')

@section('head')
 <link rel="stylesheet" href="/css/assignment.css">
@stop
 
    
<!--   @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br/><br/>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
   @endif-->

  <div class="container">  
     <div class="section-heading">
  	 <h1>Upload Assignment</h1>
  	 <hr/>
     </div>


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

            <div class="form-group text-center">
                {!! Form::file('assessment',['class'=>'form-control']) !!}
            </div>

            <div id="txtGroup" class="form-group text-center">
                <input type="text" name="students[0]" class="form-control " placeholder="Member's ID Number">
            </div>

            <div class="form-group text-center">
                <a href="#" id="addButton" class=" btn  btn-success">Add Group member</a>
            </div>


            <div class="form-group text-center">
                {!! Form::submit('Upload',['class'=>'btn btn-lg btn-primary mid btn-padding']) !!}
            </div>
        {!! Form::close() !!}

     
  </div>
 @stop
 
 @section('scripts')
<script type="text/javascript">
  
     console.log("hi");

     var counter=0;
          
      $("#addButton").click( function (){
            counter++;

             var newInput = document.createElement('input');
             newInput.setAttribute('type','text');
             newInput.setAttribute('name',('students[' + counter + ']'));
             newInput.setAttribute('class', 'form-control');
             newInput.setAttribute('placeholder', "Member's ID Number");
             document.getElementById("txtGroup").appendChild(newInput);


     });

</script>

 @stop
