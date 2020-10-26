<?php

namespace App\Http\Livewire;

use App\Mail\testlinkMail;
use App\Project;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class EditProject extends Component
{
    public $project;
    public $surveyId;

    public $programmer;
    public $project_manager;
    public $survey_number;
    public $detail;
    public $feldstart;
    public $status;
    public $mail_sent_at;

    public $showEditProject = false;

    protected $listeners = ['sendSurveyId', 'showEditProject'];
    protected $rules = [
        'survey_number'     => 'required',
        'programmer'        => 'required',
        'project_manager'   => 'required',
        'detail'            => 'required',
        'feldstart'         => 'required',
        'status'            => 'required',

    ];

    public function closeEditProject()
    {
        $this->showEditProject = false;
    }

    public function sendSurveyId($surveyId)
    {
        $this->surveyId = $surveyId;

        #set programmmer, project_manager, etc.
        $this->project = Project::find($this->surveyId);

        $this->programmer = $this->project->programmer;
        $this->project_manager = $this->project->project_manager;
        $this->survey_number = $this->project->survey_number;
        $this->detail = $this->project->detail;
        $this->feldstart = $this->project->feldstart;
        $this->status = $this->project->status;
        $this->mail_sent_at = $this->project->mail_sent_at;


    }

    public function updateProject()
    {

        $this->validate();

        Project::find($this->surveyId)
            ->update([
                'survey_number' => $this->survey_number,
                'programmer' => $this->programmer,
                'project_manager' => $this->project_manager,
                'detail' => $this->detail,
                'feldstart' => $this->feldstart,
                'status' => $this->status
            ]);

        if($this->status == 'TL bei PL' && $this->mail_sent_at == null){
            if(count($this->project_manager) >= 2){
                $mail = Mail::to($this->project_manager[0] . '@earsandeyes.com');
                array_shift($this->project_manager);
                $mail->cc($this->project_manager);
                $mail->send(new testlinkMail());
            }else{
                $mail = Mail::to($this->project_manager[0] . '@earsandeyes.com');
                $mail->send(new testlinkMail(Project::find($this->surveyId)));
                Project::find($this->surveyId)->update([
                    'mail_sent_at' => now()
                ]);
            }


        }


        $this->showEditProject = false;
        $this->emitUp('render');

    }

    public function showEditProject()
    {
        $this->showEditProject = true;
        $this->dispatchBrowserEvent('checkSelect2');
    }

    public function render()
    {
        return view('livewire.edit-project');
    }
}
