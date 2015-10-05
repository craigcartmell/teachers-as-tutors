<?php

namespace TeachersAsTutors\Console\Commands;

use Illuminate\Console\Command;

class Invoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the monthly invoice emails.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
