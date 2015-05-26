<table class="table-bordered">
    <tr>
        <td colspan="2" class="text-center"><b>Receipt</b></td>
    </tr>
    <tr>
        <td><b>Student ID</b></td>
        <td>{{$student->id}}</td>
    </tr>
    <tr>
        <td><b>Student Name</b></td>
        <td>{{$student->name}}</td>
    </tr>
    <tr>
        <td><b>Course</b></td>
        <td>{{$assessment->course->name}}</td>
    </tr>
    <tr>
        <td><b>Assessment name</b></td>
        <td>{{$assessment->title}}</td>
    </tr>

    <tr>
        <td><b>Assessment Type</b></td>
        @if($assessment->assessment_type ==1)
            <td>Assignment</td>
        @else
            <td>Test</td>
        @endif
    </tr>

    <tr>
        <td><b>Submission ID</b></td>
        <td>{{$submission->id}}</td>
    </tr>
    <tr>
        <td><b>Date </b></td>
        <td>{{ date('F m, Y') }}</td>
    </tr>
</table>