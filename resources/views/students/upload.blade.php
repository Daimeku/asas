
{!! Form::open(['route'=>'students/upload', 'method' => 'POST', 'files' => true]) !!}

{!! Form::file('assessment') !!}
{!! Form::text('user_id', $user->id) !!}
{!! Form::text('assessment_id', $assessment->id); !!}

{!! Form::submit('submit') !!}

{!! Form::close() !!}


