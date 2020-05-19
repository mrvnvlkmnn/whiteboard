@extends('projects.layout')

@section('content')
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Edit Project</h3>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update',$project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Studien-Nummer:</strong>
                    <input type="text" name="survey_number" value="{{ $project->survey_number }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Programmierer:</strong>
                    <select class="select2 form-control" name="programmer[]" multiple size="6">
                        @foreach(config('employees.programmer') as $key => $value)
                            <option value="{{ $key }}" {{ in_array($key, old('programmer') ?? $project->programmer) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Projekt-Leiter:</strong>
                    <select class="select2 form-control" name="project_manager[]" multiple size="5">
                        @foreach(config('employees.project_manager') as $key => $value)
                            <option value="{{ $key }}" {{ in_array($key, old('project_manager') ?? $project->project_manager) ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:75px" name="detail">{{ $project->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="custom-select" name="status" size="4">
                        <option value="Kick-Off"        {{ old('info') == "Kick-Off" ? 'selected' : '' }}>Kick-Off</option>
                        <option value="Programmierung"  {{ old('info') == "Programmierung" ? 'selected' : '' }}>Programmierung</option>
                        <option value="TL bei PL"       {{ old('info') == "TL bei PL" ? 'selected' : '' }}>Testlink bei Projektleiter</option>
                        <option value="Abgeschlossen"   {{ old('info') == "Abgeschlossen" ? 'selected' : '' }}>Abgeschlossen</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>

    </form>
@endsection
