<?php

namespace App\Console\Commands;

use App\Mail\projectMail;
use App\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a mail to IT@earsandeyes.com';

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
     * @return mixed
     */
    public function handle()
    {
        Mail::to('it@earsandeyes.com')->send(new projectMail(Project::all()));
    }
}
