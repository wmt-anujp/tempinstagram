<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class time extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will run on alloted time';

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
        echo "some every minute";
    }
}
