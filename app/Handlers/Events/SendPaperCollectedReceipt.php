<?php namespace App\Handlers\Events;

use App\Events\PaperWasCollected;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Support\Facades\Mail;

use DB;
use App\Models\User;
use App\Models\Submission;


class SendPaperCollectedReceipt {

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
	 * @param  PaperWasCollected  $event
	 * @return void
	 */
	public function handle(PaperWasCollected $event)
	{
        $student = User::find($event->student_id);
        $submission = $student->submissions()->where('assessment_id',$event->assessment_id)->first();
        DB::table('user_submissions')->where('user_id',$student->id)->where('submission_id',$submission->id)
            ->update(['paper_collected'=>1]);

        $data = [
            'student' => $student->sanitize(),
            'submission' => $submission
        ];

        Mail::send('emails/receipt',$data, function($message){
            $message->from('ASAS-TEST@gmail.com');
            $message->to('daimeku@gmail.com', 'Ashani kentish')->subject('TEST PAPER COLLECTED');
        });

	}

}
