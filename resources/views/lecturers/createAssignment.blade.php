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

<!--<form class="form-horizontal" action="teachers/createAssignment" method="POST">-->
{!! Form::open(['route'=>'teachers/create', 'method' => 'POST']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <fieldset>

        <!-- Form Name -->
        <legend>new assignment</legend>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="title">title</label>
            <div class="controls">
                <input id="title" name="title" type="text" placeholder="assignment name" value="{{{Input::old('title')}}}" class="input-xlarge">
                <p class="help-block">e.g "Assignment 5"</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="description">description</label>
            <div class="controls">
                <input id="description" name="description" type="text" placeholder="assignment description" value="{{{Input::old('description')}}}" class="input-xlarge">
                <p class="help-block">help</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="filepath">filepath</label>
            <div class="controls">
                <input id="filepath" name="filepath" type="text" placeholder="placeholder" value="{{{Input::old('filepath')}}}" class="input-xlarge">
                <p class="help-block">help</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="start_date">start date</label>
            <div class="controls">
                <input id="start_date" name="start_date" type="text" placeholder="placeholder" value = "{{{Input::old('start_date')}}}" class="input-xlarge">
                <p class="help-block">help</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="end_date">end date</label>
            <div class="controls">
                <input id="end_date" name="end_date" type="text" placeholder="placeholder" value="{{{Input::old('end_date')}}}" class="input-xlarge">
                <p class="help-block">help</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="assessment_type">assessment type</label>
            <div class="controls">
                <input id="assessment_type" name="assessment_type" type="text" placeholder="placeholder" value="{{{Input::old('assessment_type')}}}" class="input-xlarge">
                <p class="help-block">help</p>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="course_id">course_id</label>
            <div class="controls">
                <input id="course_id" name="course_id" type="text" placeholder="placeholder"  value="{{{Input::old('course_id')}}}" class="input-xlarge">
                <p class="help-block">help</p>
            </div>
        </div>

        <div class="control-group">
            <input type="submit" value="submit">
        </div>

    </fieldset>
<!--</form>-->

{!! Form::close() !!}
