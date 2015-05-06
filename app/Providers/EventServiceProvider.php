<?php namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\StudentEnteredTest;
use App\Handlers\Events\SendEnteredTestReceipt;
use App\Handlers\Events\SendPaperCollectedReceipt;
use App\Handlers\Events\PaperWasCollected;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'event.name' => [
			'EventListener',
		],

        StudentEnteredTest::class => [ SendEnteredTestReceipt::class],
        PaperWasCollected::class => [ SendPaperCollectedReceipt::class]

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		//
	}

}
