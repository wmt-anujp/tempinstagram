<?php

use App\Models\User\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('userData', function () {
    $this->table(['Name', 'Email', 'Username'], User::all(['name', 'email', 'username']));
})->purpose('For Displaying all user data');

Artisan::command('mail:send {user*} {--l|lname=panchal}', function ($user) {
    if ($this->confirm('Are you 18+')) {
        $this->info("Sending email to: {" . print_r($user) . "}!");
        $argument = $this->argument('user');
        print_r($argument);
        $this->newline();
        $option = $this->option('lname');
        echo $option;
        $this->newline();
    }
})->purpose('Sending mail');

Artisan::command('progressbar', function () {
    $users = User::all();
    $bar = $this->output->createProgressBar(count($users));
    $bar->start();
    foreach ($users as $user) {
        $this->performTask($user);

        $bar->advance();
    }
    $bar->finish();
});
