<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

/*
 * Event triggered when a student has entered the examination venue
 * called from invigilatorsController@enterTest
 */
class StudentEnteredTest extends Event {

	use SerializesModels;

    public $submission_id;
    public $student_id;

	/*
	 * create a new event and add the student and submission id
	 * @return void
	 */
	public function __construct($student_id, $submission_id)
	{
		//
        $this->student_id = $student_id;
        $this->submission_id = $submission_id;
	}

}
