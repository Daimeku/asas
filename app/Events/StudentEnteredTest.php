<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class StudentEnteredTest extends Event {

	use SerializesModels;

    public $submission_id;
    public $student_id;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($student_id, $submission_id)
	{
		//
        $this->student_id = $student_id;
        $this->submission_id = $submission_id;
	}

}
