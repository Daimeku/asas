@extends('invigilators.master')


@section('content')
 <div class="container text-center">
    <div class="section-heading">
       <h1>My Schedule</h1>
       <hr/>
    </div>
    
    
		 <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Current Date</th>
                <th>Date of Test</th>
                <th>Course</th>
                <th>Venue</th>
                <th>Start Time</th>
            </tr>
        </thead>            
        <tbody>

        @if(!$tests->isEmpty())
            @foreach($tests as $test)
                    <tr>
                        <td>{{ date('F d, Y') }}</td>
                        <td>{{ date('F d, Y',strtotime($test->start_date)) }}</td>
                        <td>{{ $test->course->name }}</td>
                        <td>{{ $test->course->occurrences->first()->location->location }}</td>
                        <td>{{ date('H:i',strtotime($test->start_date)) }}</td>
<!--                        $test->start_date->toDateTimeString()-->
                        @if( date('Y-m-d H:i:s') >=  date('Y-m-d H:i:s',strtotime($test->start_date->toDateTimeString() )))
                            <td>
                                <a href="{{{ route('invigilators/studentEntryEmpty',['assessment_id'=>$test->id]) }}}">Go</a>
                            </td>
                        @endif
                     </tr>
            @endforeach
        @endif

        </tbody>                            
     </table>
  </div>    	
</div>
    
</div>
@stop

 