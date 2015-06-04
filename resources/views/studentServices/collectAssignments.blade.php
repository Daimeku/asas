@extends('studentServices.master')


@section('content')
<div class="container text-center">
     <div class="section-heading">
       <h1>Collect Assignments</h1>
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

    {!! Form::open(['method'=>'POST','route'=>['studentServices/search'], 'class'=>'form-horizontal width-50 center-block margin-b-100']) !!}


    @if(Session::has('student'))
    <div class="form-group">
        <img src="{{Session::get('student')->image_file_path}}" scrolling="no" width="255" height="227" align="middle" frameborder="1" style="border-color:black;"  marginheight=50" name="Changeable"></img>

    </div>
    @endif

    <br><br>
    @if(Session::has('submission'))
    <div class="form-group">
        <div class=" ">
            <table class=" table table-bordered" >
                <tr>
                    <td><b>Course</b></td>
                    <td>{{Session::get('submission')->assessment->course->name}} </td>
                </tr>
                <tr>
                    <td><b>Assignment</b></td>
                    <td>{{ Session::get('submission')->assessment->title }}</td>
                </tr>
            </table>

        </div>

    </div>

    @endif

    <div class="form-group">
        <input type="text" name="submission_id" class="form-control" placeholder="Enter Submission ID">


        <input type="text" name="user_id" class="form-control" placeholder="Enter Student ID">
    </div>





	


    <div class="form-group">
        <input type="reset" value="Clear" class="btn btn-info"/>
        @if(Session::has('student'))
<!--            <a href=""  class="btn btn-danger">Remove</a>-->
            <a href="{{{ route('studentServices/accept',['user_id'=>Session::get('student')->id, 'submission_id'=>Session::get('submission')->id]) }}}"  class="btn btn-success">Accept</a>
        @endif
        <input type="submit" value="Search" target="Changeable" class="btn btn-default"/>
    </div>




    {!! Form::close() !!}
	 
		 
</div>
@stop



