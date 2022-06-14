<?php

namespace App\Console\Commands;

use App\Models\User\User;
use Illuminate\Console\Command;


class generateUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:generate-users {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates test user data and insert into the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('showDB');
        $userData = $this->argument('count');
        for ($i = 0; $i < $userData; $i++) {
            User::Factory()->create();
        }
    }
}
