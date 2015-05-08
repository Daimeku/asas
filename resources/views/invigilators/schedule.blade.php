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
                <th>Lecturer</th>
                <th>Start Time</th>
                <th>Duration</th>
            </tr>
        </thead>            
        <tbody>
            <tr>
                <td>May 1, 2015</td>
                <td>Data Structures</td>
                <td>LT-2B1</td>
                <td>Tyrone Edwards</td>
                <td>3pm</td> 
                <td>1 HR 30 Mins</td>    
             </tr>
             <tr>
                <td>May 3, 2015</td>
                <td>Data Structures</td>
                <td>LT-2B1</td>
                <td>Tyrone Edwards</td>
                <td>3pm</td>
                <td>1 HR 30 Mins</td>
             </tr>  
        </tbody>                            
     </table>
  </div>    	
</div>
    
</div>
@stop

 