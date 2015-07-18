<?php namespace App\Console;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\MailController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
             //   $schedule->call(join('@',[WebsiteController::class,'googlePosition']));
                $schedule->call('App\Http\Controllers\Website\WebsiteController@googlePosition')->daily();
                $schedule->call('App\Http\Controllers\MailController@mailGroups')->twiceDaily();
                $schedule->call('App\Http\Controllers\MailController@mailNewsletter')->mondays();
                $schedule->call('App\Http\Controllers\MailController@mailNewsletter')->tuesdays();
	}

}
