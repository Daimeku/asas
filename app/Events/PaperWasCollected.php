<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

/*
 * For use in invigilatorsController when a paper has been accepted from a student
 * triggers email receipt transfer in handler
 * called from : InvigilatorsController@collectPaper
 */
class PaperWasCollected extends Event {

	use SerializesModels;

    public $student_id;
    public $assessment_id;
    public $paper_id;

	/*
	 * construct event
	 * set student id, assesment id and paper id
	 * @return void
	 */
	public function __construct($student_id, $assessment_id, $paper_id)
	{
		$this->student_id = $student_id;
        $this->assessment_id = $assessment_id;
        $this->paper_id = $paper_id;

	}

}
