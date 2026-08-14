<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //Commands\SendSMSEmail::class,
        Commands\BackupDatabaseCommand::class,
        Commands\BirthdayWish::class,
        Commands\BalanceFeesReminder::class,
        Commands\LibraryClearance::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //* * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

        // $schedule->command('inspire')
        //          ->hourly();

        //Minute	Hour	Day	Month	Weekday
        /*$schedule->command('queue:work --tries=18')
            ->cron('* * * * * *')
            ->withoutOverlapping();*/

        $timeZone = getEnv('APP_TIMEZONE');

        //Custom Cron
        //Birthday Wish
        $schedule->command('command:birthdaywish')
            ->everyMinute()
            ->timezone($timeZone);

        //Due Fee Reminder
        $schedule->command('command:duefeereminder')
            ->monthly()
            ->timezone($timeZone);

        //Library Clearance Reminder
        $schedule->command('command:libraryclearance')
            ->daily()
            ->timezone($timeZone);

        //Schedule Que Work
        $schedule->command('queue:work --tries=18')
            ->everyFifteenMinutes()
            ->timezone($timeZone)
            ->withoutOverlapping();


        //Database backup
        $schedule->command('backup:clean')->daily()->at('05:00');
        $schedule->command('backup:run')->daily()->at('06:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
