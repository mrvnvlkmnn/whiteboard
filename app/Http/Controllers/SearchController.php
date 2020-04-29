<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     *Display  a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchQuery = "%" . $request->searchQuery . "%";


        $sql = Project::where(function ($query) use ($searchQuery) {
            $query->where('survey_number', 'LIKE', $searchQuery)
                ->orWhere('programmer', 'LIKE', $searchQuery)
                ->orWhere('project_manager', 'LIKE', $searchQuery)
                ->orWhere('detail', 'LIKE', $searchQuery)
                ->orWhere('info', 'LIKE', $searchQuery)
                ->orWhere('deleted_at', '=', 'NULL');
        });


        if ($request->filterQuery !== "Alle") {
            if ($request->filterQuery !== "Gelöscht"){
                $sql = $sql->where('status', '=', $request->filterQuery);
            }else{
                $sql = Project::onlyTrashed();
            }

        }

        return $sql->get();
        /*
        return Project::where('survey_number', 'LIKE', $searchQuery)
            ->orWhere('programmer', 'LIKE', $searchQuery)
            ->orWhere('project_manager', 'LIKE', $searchQuery)
            ->orWhere('detail', 'LIKE', $searchQuery)
            ->orWhere('info', 'LIKE', $searchQuery)
            ->where('status', '=', $request->filterQuery)
            ->get();
        */
    }

    public function delete($project)
    {
        Project::where('id', $project)->update(["status" => "Gelöscht"]);

        return Project::where('id', $project)->delete();

        // Alternativen
        // Project::where('id', $project)->delete();
        // Project::whereId($project);

    }
}
