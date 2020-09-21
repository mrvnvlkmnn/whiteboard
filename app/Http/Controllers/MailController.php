<?php

namespace App\Http\Controllers;

use App\Mail\projectMail;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Response
     */
    public function sendMail()
    {
        $mailCC = request('programmer');

        if(empty($mailCC)){
            $mailAddress = "it@earsandeyes.com";
        }else{
            $mailAddress = array_shift($mailCC);
        }
        $mailSend = Mail::to($mailAddress);


        if (sizeof($mailCC) !== 0){
                $mailSend = $mailSend->cc($mailCC);
        }



        $mailSend = $mailSend->send(new projectMail(Project::orderBy("feldstart", 'DESC')->get()));

        return redirect('/sendMail')
            ->with('Erfolgreich!', 'E-Mail erfolgreich gesendet');
    }


    public function show()
    {
        return view('sendMail');
    }
}
