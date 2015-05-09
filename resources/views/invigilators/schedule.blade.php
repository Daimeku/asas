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
                <th>Date of Test</th>
                <th>Course</th>
                <th>Venue</th>
                <th>Start Time</th>
            </tr>
        </thead>            
        <tbody>

        @if(!$tests->isEmpty())
            @foreach($tests as $test)
                @foreach($test->course->occurrences as $occurrence)
                    <tr>
                        <td>{{ date('F d, Y',strtotime($test->time)) }}</td>
                        <td>{{ $test->course->name }}</td>
                        <td>{{ $occurrence->location->location }}</td>
                        <td>{{ date('H:i',strtotime($test->time)) }}</td>
                     </tr>
                @endforeach
            @endforeach
        @endif

        </tbody>                            
     </table>
  </div>    	
</div>
    
</div>
@stop

 