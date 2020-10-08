<?php

namespace App\Http\Livewire;

use App\Project;
use Illuminate\Http\Request;
use Livewire\Component;

class SearchController extends Component
{
    public $surveysOverview;
    public $search;
    public $surveys;
    public $filterQuery;
    public $columnName;
    public $order;

    protected $listeners = ['searching' => 'search'];

    public function mount(){
        $this->surveysOverview = Project::all();
        $this->surveys = $this->search();

    }

    public function search()
    {

        $searchQuery = "%" . $this->search . "%";


        $sql = Project::where(function ($query) use ($searchQuery) {
            $query->where('survey_number', 'LIKE', $searchQuery)
                ->orWhere('programmer', 'LIKE', $searchQuery)
                ->orWhere('project_manager', 'LIKE', $searchQuery)
                ->orWhere('detail', 'LIKE', $searchQuery)
                ->orWhere('deleted_at', '=', 'NULL');
        });

        //$sql = $sql->orderBy('survey_number', 'asc');


        /*
        if ($this->filterQuery !== "Alle") {
            $sql = $sql->where('status', '=', $this->filterQuery);
        }
        if(!empty($this->columnName)){
            $sql = $sql->orderBy($this->columnName, $this->order);
        }
*/
        return $sql->get();

    }

    public function countProgrammierung(Request $request){

        $collection = Project::groupBy('status')
            ->selectRaw('count(*)')
            ->get();
        return $collection;
    }

    public function delete($project)
    {
        Project::where('id', $project)->update(["status" => "Gelöscht"]);

        return Project::where('id', $project)->delete();


    }

    public function render()
    {
        return view('livewire.search-controller');
    }
}
