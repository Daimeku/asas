@extends('invigilators.master')


@section('content')
 <div class="container text-center">

    <div class="section-heading">
       <h1>My Schedule</h1>
       <hr/>
    </div>
    
    
     <div class="table-responsive">
        <table border="1" class="table-striped table ">
            <thead >
                <tr>
                    <th class="text-center">Current Date</th>
                    <th class="text-center">Date of Test</th>
                    <th class="text-center">Course</th>
                    <th class="text-center">Venue</th>
                    <th class="text-center">Start Time</th>
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
    

@stop

 