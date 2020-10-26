<?php

namespace App\Observers;

use App\Project;

class ProjectObserver
{
    /**
     * Handle the project "created" event.
     *
     * @param Project $project
     * @return void
     */
    public function created(Project $project)
    {
        //
    }

    /**
     * Handle the project "updated" event.
     *
     * @param Project $project
     * @return void
     */
    public function updated(Project $project)
    {

    }

    /**
     * Handle the project "deleted" event.
     *
     * @param Project $project
     * @return void
     */
    public function deleting(Project $project)
    {
        info("test");
        $project->status = "Gelöscht";
    }

    /**
     * Handle the project "restored" event.
     *
     * @param Project $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     *
     * @param Project $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
