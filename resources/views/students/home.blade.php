students home page

{{$user->email}}
<br/>
dashboard would be here
<br/>
<ul>
@foreach($current_courses as $course)
<li>
	{{$course->start_date}}
	</li>
@endforeach
</ul>