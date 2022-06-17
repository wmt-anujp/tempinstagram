<?php

namespace App\Console\Commands;

use App\Models\User\User;
use Illuminate\Console\Command;

class getUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getUserData:send {user*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display all user data';

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
        $this->table(['Name', 'Email', 'Username'], User::all(['name', 'email', 'username']));
    }
}
