<?php

namespace App\Http\Livewire;

use App\Mail\testlinkMail;
use App\Project;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EditProject extends Component
{
    public $project;
    public $surveyId;

    public $programmer;
    public $project_manager;
    public $survey_number;
    public $detail;
    public $fieldstart;
    public $status;
    public $mail_sent_at;
    public $update_list;

    public $showEditProject = false;

    protected $listeners = ['sendSurveyId', 'showEditProject'];

    //defines rules for validation
    protected $rules = [
        'survey_number' => 'required',
        'programmer' => 'required',
        'project_manager' => 'required',
        'detail' => 'required',
        'fieldstart' => 'required|date:d-m-Y',
        'status' => 'required',

    ];

    //closes the window
    public function closeEditProject()
    {
        $this->showEditProject = false;
    }

    //sends the id to identify the project to edit
    //sets all the variables to show in the edit window
    public function sendSurveyId($surveyId)
    {

        $this->surveyId = $surveyId;

        #set programmmer, project_manager, etc.
        $this->project = Project::find($this->surveyId);

        $this->programmer = $this->project->programmer;
        $this->project_manager = $this->project->project_manager;
        $this->survey_number = $this->project->survey_number;
        $this->detail = $this->project->detail;
        $this->fieldstart = $this->project->fieldstart->format('Y-m-d');
        $this->status = $this->project->status;
        $this->mail_sent_at = $this->project->mail_sent_at;
    }

    private function checkIfDataChange(): array
    {
        $arr = ['type' => 'project_updated',
            'changes' => [
            ]];

        foreach ($this->project->getAttributes() as $key => $value) {
            if (!in_array($key, $this->project->getFillable()) or $key == 'update_list') {
                continue;
            }
            if($key == 'fieldstart'){
                if ($this->project->{$key}->format('Y-m-d') != $this->{$key}) {
                    $arr['changes'][$key] = [
                        'old' => $this->project->{$key},
                        'new' => $this->{$key}
                    ];
                }
                continue;
            }
            if ($this->project->{$key} != $this->{$key}) {
                $arr['changes'][$key] = [
                    'old' => $this->project->{$key},
                    'new' => $this->{$key}
                ];
            }
        }

        return $arr;
    }

    //updates the project in the db
    public function updateProject()
    {
        $json = $this->project->update_list;
        $changes = $this->checkIfDataChange();
        if(count($changes['changes']) > 0){
            $json[time()] = $changes;
        }

        /*
        if($this->checkIfDataChange()){
            echo "test";
        }
        */

        //validates data
        $this->validate();

        Project::find($this->surveyId)
            ->update([
                'survey_number' => $this->survey_number,
                'programmer' => $this->programmer,
                'project_manager' => $this->project_manager,
                'detail' => $this->detail,
                'fieldstart' => $this->fieldstart,
                'status' => $this->status,
                'update_list' => $json,
            ]);

        //checks if status equals 'TL bei PL', if so its sends a mail to the project manager who works on this survey
        if ($this->status == 'TL bei PL' && $this->mail_sent_at == null) {
            //checks if more then 1 project manager is working on the project
            //if so, it puts the second project manager in cc
            if (count($this->project_manager) >= 2) {
                $mail = Mail::to($this->project_manager[0] . '@earsandeyes.com');
                array_shift($this->project_manager);
                $mail->cc($this->project_manager);
                $mail->send(new testlinkMail());
            } else {
                $mail = Mail::to($this->project_manager[0] . '@earsandeyes.com');
                $mail->send(new testlinkMail(Project::find($this->surveyId)));
                Project::find($this->surveyId)->update([
                    'mail_sent_at' => now()
                ]);
            }
        }

        //sets the variable to show to window to false,
        //emtis event to parent controller and count-projects controller to render the updated entrys
        $this->showEditProject = false;
        $this->emitUp('render');
        $this->emitTo('count-projects', 'render');

    }

    //shows the window
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
