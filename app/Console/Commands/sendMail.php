<?php

namespace App\Console\Commands;

use App\Mail\projectMail;
use App\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $temp = [];
        $timeStamps = DB::select('select updated_at from projects');

        foreach($timeStamps as $key => $value){
            foreach ($value as $timestamp){
                $split = str_split($timestamp, 10);
                array_push($temp, $split[0]);
            }

        }
        $counter = 0;

        foreach($temp as $date){
            $time = round((strtotime("now") - strtotime($date)) / 60 / 60 /24,0);

            if ($time <= 1){
                $counter++;

            }
        }

        //dd($counter);

        if ($counter > 0){
            Mail::to('it@earsandeyes.com')->send(new projectMail(Project::orderBy('feldstart', 'DESC')->get()));
        }

    }
}
