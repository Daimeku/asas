<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class PaperWasCollected extends Event {

	use SerializesModels;

    public $student_id;
    public $assessment_id;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($student_id, $assessment_id)
	{
		$this->student_id = $student_id;
        $this->assessment_id = $assessment_id;

	}

}
