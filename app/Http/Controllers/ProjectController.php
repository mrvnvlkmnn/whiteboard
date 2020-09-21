<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Product;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(5);

        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $year = "Q" . substr(date("Y"), 0, 2) . "0XXde";

        return view('projects.create')->with('year', $year);
    }


    /**
     * Store a newly created resource in storage
     *
     * @param StoreProjectRequest $request
     * @return Response
     */
    public function store(StoreProjectRequest $request)
    {

        $request->validated();

        $all = $request->all();
        $all['programmer'] = implode(',', $all['programmer']);
        $all['project_manager'] = implode(',', $all['project_manager']);

        Project::create($all);

        return redirect()->route('projects.index')
            ->with('Erfolgreich!', 'Projekt wurde erfolgreich erstellt.');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Project $project)
    {
        $project->programmer = preg_split('/,/', $project->programmer);
        $project->project_manager = preg_split('/,/', $project->project_manager);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreProjectRequest $request
     * @param Project $project
     * @return Response
     */
    public function update(Project $project, UpdateProjectRequest $request)
    {


        // php artisan make:request StoreBlogPost (auslagerung von Validierung im Controller)
        $request->validated();

        $all = $request->all();
        $all['programmer'] = implode(',', $all['programmer']);
        $all['project_manager'] = implode(',', $all['project_manager']);

        $project->update($all);

        return redirect()->route('projects.index')
            ->with('Erfolgreich!', 'Projekt wurde erfolgreich aktualisiert.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('Erfolgreich!', 'Projekt wurde erfolgreich gelöscht.');
    }


}
