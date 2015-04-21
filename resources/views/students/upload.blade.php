
{!! Form::open(['route'=>'students/upload', 'method' => 'POST', 'files' => true]) !!}

    {!! Form::file('assessment') !!}
    {!! Form::text('user_id', 2); !!}
    {!! Form::text('assessment_id', 1); !!}

    {!! Form::submit('submit') !!}

{!! Form::close() !!}


