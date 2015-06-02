<?php namespace App\Handlers\Events;

use App\Events\StudentEnteredTest;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendEnteredTestReceipt {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  StudentEnteredTest  $event
	 * @return void
	 */
	public function handle(StudentEnteredTest $event)
	{
        $student = User::find($event->student_id);
        $submission = $student->submissions()->where('id',$event->submission_id)->first();
        $assessment= new \stdClass();
        if($submission != null){
            $assessment = $submission->assessment;
        }
        $data = [
            'student' => $student->sanitize(),
            'submission' => $submission,
            'assessment' => $assessment
        ];
		//send email confirmation to student
        Mail::send('emails/receipt',$data, function($message){
            $message->from('ASAS-TEST@gmail.com');
            $message->to('daimeku@gmail.com', 'Ashani kentish')->subject('Student entered test');
        });
	}


}
