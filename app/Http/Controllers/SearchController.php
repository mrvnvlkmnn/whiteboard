<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     *Display  a listing of the resource
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $searchQuery = "%" . $request->searchQuery . "%";


        $sql = Project::where(function ($query) use ($searchQuery) {
            $query->where('survey_number', 'LIKE', $searchQuery)
                ->orWhere('programmer', 'LIKE', $searchQuery)
                ->orWhere('project_manager', 'LIKE', $searchQuery)
                ->orWhere('detail', 'LIKE', $searchQuery)
                ->orWhere('deleted_at', '=', 'NULL');
        });

        //$sql = $sql->orderBy('survey_number', 'asc');

        if ($request->filterQuery !== "Alle") {
            $sql = $sql->where('status', '=', $request->filterQuery);
        }

        switch ($request->tableNumber) {
            case 1:
                $sql = $sql->orderBy('survey_number', 'asc');
            case 2:
                $sql = $sql->orderBy('survey_number', 'desc');
            case 3:
                $sql = $sql->orderBy('programmer', 'asc');
            case 4:
                $sql = $sql->orderBy('programmer', 'desc');
            case 5:
                $sql = $sql->orderBy('project_manager', 'asc');
            case 6:
                $sql = $sql->orderBy('project_manager', 'desc');
            case 7:
                $sql = $sql->orderBy('detail', 'asc');
            case 8:
                $sql = $sql->orderBy('detail', 'desc');
            case 9:
                $sql = $sql->orderBy('feldstart', 'asc');
            case 10:
                $sql = $sql->orderBy('feldstart', 'desc');
        }


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
}
