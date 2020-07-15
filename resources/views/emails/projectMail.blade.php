@component('mail::message')

# Liste der aktuellen Studien
derzeit stehen folgende Studien an:

@component('mail::table')
| Studien-Nummer       | Programmierer          | Projektleiter          | Details          | geplanter Feldstart         | Status  |
| -------------------- |:----------------------:|:----------------------:|:----------------:|:---------------------------:| -------:|
@foreach($projects as $project)
| {{ $project->survey_number }} | {{ $project->programmer }} | {{ $project->project_manager }} | {{ $project->detail }} | {{ date("d.m.Y", strtotime($project->feldstart)) }} | {{ $project->status }} |
@endforeach
@endcomponent
@endcomponent
