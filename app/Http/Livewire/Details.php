<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Details extends Component
{
    public $showDetails = false;
    public $surveyId;

    protected $listeners = ['sendSurveyId', 'showDetails'];

    public function showDetails(){
        $this->showDetails = true;
    }

    public function sendSurveyId($surveyId){
        $this->surveyId = $surveyId;
    }

    public function render()
    {
        return view('livewire.details');
    }
}
