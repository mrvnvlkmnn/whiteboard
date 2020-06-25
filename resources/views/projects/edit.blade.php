@extends('projects.layout')

@section('content')
    <div class="text-row" style="margin-bottom: 20px;">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <h3>Projekt bearbeiten</h3>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Es gab einen Fehler mit deiner Eingabe.<br><br>
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
                    <label>
                        <strong>Studien-Nummer:</strong>
                        <input type="text" name="survey_number" value="{{ $project->survey_number }}" class="form-control">
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Programmierer:</strong>
                    <br>
                    <label style="width: 500px">
                        <select class="select2 form-control" name="programmer[]" multiple size="6">
                            @foreach(config('employees.programmer') as $key => $value)
                                <option value="{{ $key }}" {{ in_array($key, old('programmer') ?? $project->programmer) ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Projektleiter:</strong>
                    <br>
                    <label style="width: 500px">
                        <select class="select2 form-control" name="project_manager[]" multiple size="5">
                            @foreach(config('employees.project_manager') as $key => $value)
                                <option value="{{ $key }}" {{ in_array($key, old('project_manager') ?? $project->project_manager) ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label style="width: 500px">
                        <strong>Detail:</strong>
                        <textarea class="form-control" style="height:75px" name="detail">{{ $project->detail }}</textarea>
                    </label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>
                        <strong>geplanter Feldstart:</strong>
                        <input class="form-control" type="date" name="feldstart" value="{{ old('feldstart', $project->feldstart) }}">
                    </label>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <br>
                    <label style="width: 500px">
                        <select class="custom-select" name="status" size="4">
                            <option value="Kick-Off"        {{ old('status', $project->status) == "Kick-Off" ? 'selected' : '' }}>Kick-Off</option>
                            <option value="Programmierung"  {{ old('status', $project->status) == "Programmierung" ? 'selected' : '' }}>Programmierung</option>
                            <option value="TL bei PL"       {{ old('status', $project->status) == "TL bei PL" ? 'selected' : '' }}>Testlink bei Projektleiter</option>
                            <option value="Im Feld"         {{ old('status', $project->status) == "Im Feld"? 'selected' : '' }}>Im Feld</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Speichern</button>
            </div>
        </div>

    </form>
@endsection
