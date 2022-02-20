<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Mail\WinnerMail;

class CheckIdeas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:ideas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check is idea is fulfill';

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
        Mail::to("amfarhad33@gmail.com")->send(new WinnerMail());
        return 0;
    }
}
