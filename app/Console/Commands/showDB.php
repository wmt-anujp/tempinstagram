<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class showDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'showDB';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows current Database';

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
        $this->info("Current Connected Database is:" . DB::connection()->getDatabaseName());
        $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
        echo $name;
        $this->newLine();
        $gender = $this->choice(
            'What is your gender?',
            ['Male', 'Female'],
            // $defaultIndex,
            $maxAttempts = "null",
            $allowMultipleSelections = true
        );
        echo $gender;
        $this->newLine();
    }
}
