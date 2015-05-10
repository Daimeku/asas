
@extends('lecturers.master')

@section('head')
<link rel="stylesheet" href="/css/assignment.css">
<link rel="stylesheet" href="/css/jQueryUI/jquery-ui.min.css">
@stop


@section('content')

    @if(Session::has('success'))
        <div class="alert alert-success">
            <strong>Success!</strong> {{ Session::get('success') }}<br><br>
        </div>
    @endif

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

    <div class="section-heading">
        @if($assessment->assessment_type == 1)
        <h1 id="heading">Edit Assignment</h1>
        @else
        <h1 id="heading">Edit Test</h1>
        @endif
        <hr/>

    </div>

    {!! Form::model($assessment, ['route'=>['teachers/edit', $assessment->id], 'method' => 'POST', 'files'=>true, 'class'=>"assignment-form form-horizontal",'name'=>"assignment_test" ]) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="assessment_type" id="assessment_type" value="1">

    <!-- Assignment Name -->
    <div class="form-group">
<!--        <input id="title" name="title" type="text" placeholder="Enter Assignment or Test name" value="{{{Input::old('title')}}}" class="form-control">-->
        {!! Form::text('title', Input::old('title'), ['class'=>'form-control']) !!}
    </div>

    <!-- Description -->
    <div class="form-group">
        {!! Form::textarea('description', null, array('id'=>'description', 'class' => 'form-control', 'rows'=> 3, 'placeholder'=>"Enter the Assignment or Test Description here")) !!}

    </div>
    @if($assessment->assessment_type == 1)
        <!--Upload-->
        <div id="uploadAssignment" class="form-group">
            <div class= "row">
                <div class="col-md-7 removeLeftPadding">
                    <input id="txtFileName" name="filename" type="text" placeholder="assignment name" value="{{{Input::old('filename')}}}" class="form-control">

                </div>

                <div class="col-md-5  ">
                    {!! Form::file('assessment') !!}

                </div>

            </div>
        </div>
    @endif

    <!--Classroom + Time -->
    @if($assessment->assessment_type == 2)
        <div id="testInfo" class="form-group ">
            <div class= "row">
                <div class="col-md-7 removeLeftPadding">
                    <input id="txtTestVenue" name="upload" type="text" placeholder="Test Venue" value="" class="form-control">
                </div>
                <div class="col-md-5">
                    <select id="time" name="time" type="text" placeholder="Test Time" value="" class="form-control select">
                        <option value="8">8AM</option>
                        <option value="9">9AM</option>
                        <option value="10">10AM</option>
                        <option value="11">11AM</option>
                        <option value="12">12PM</option>
                        <option value="13">1PM</option>
                        <option value="14">2PM</option>
                        <option value="15">3PM</option>
                        <option value="16">4PM</option>
                        <option value="17">5PM</option>
                        <option value="18">6PM</option>
                        <option value="19">7PM</option>
                        <option value="20">8PM</option>
                        <option value="21">9PM</option>
                    </select>
                </div>
            </div>
        </div>
    @endif

    <!-- Start Date -->
    <div class="form-group">
<!--        <input id="start_date" name="start_date" type="text" placeholder="Click to Select Start Date" value = "{{{Input::old('start_date')}}}" class="form-control">-->
        {!! Form::text('start_date', null, ['class'=> 'form-control']) !!}
    </div>

    @if($assessment->assessment_type === 1)
        <!-- End Date -->
        <div class="form-group">
    <!--        <input id="end_date" name="end_date" type="text" placeholder="Click to Select due date" value="{{{Input::old('end_date')}}}" class="form-control">-->
            {!! Form::text('end_date', null, ['class'=> 'form-control']) !!}

        </div>
    @endif

    <!-- Course-->
    <!-- Course-->
    <div class="form-group">
        <!--<input id="course_id" name="course_id" type="text" placeholder="placeholder"  value="{{{Input::old('course_id')}}}" class="input-xlarge">-->
        {!! Form::select('course_id', $courses, null, ['class'=> 'form-control']) !!}

    </div>


    <div class="form-group text-center">
        <input type="submit" value="Update" class="btn btn-lg btn-primary mid btn-padding">
        <a href=" {{{ route('teachers/assessment',['assessment_id' => $assessment->id]) }}}" class="btn btn-lg btn-primary mid btn-padding" >Cancel</a>
    </div>

    {!! Form::close() !!}

@stop

@section('scripts')

    <script src="/js/jQueryUI/jquery-ui.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#start_date").datepicker();
            $("#end_date" ).datepicker();
        });
    </script>

@stop