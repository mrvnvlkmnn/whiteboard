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
                    <select class="custom-select w-100" name="programmer[]" multiple size="5">
                        <option value="DS" {{ old('programmer') == "DS" ? 'selected' : '' }}>Dennis Silberbach</option>
                        <option value="NS" {{ old('programmer') == "NS" ? 'selected' : '' }}>Nico Sorgenfrei</option>
                        <option value="MY" {{ old('programmer') == "MY" ? 'selected' : '' }}>Mawlid Yussuf</option>
                        <option value="MV" {{ old('programmer') == "MV" ? 'selected' : '' }}>Marvin Volkmann</option>
                        <option value="unknown" {{ old('programmer') == "unknown" ? 'selected' : '' }}>IT</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Projekt-Leiter:</strong>
                    <select class="custom-select w-100" name="project_manager[]" multiple size="5">
                        <option value="DJ" {{ old('project_manager') == "DJ" ? 'selected' : '' }}>Debora Jahnke</option>
                        <option value="EH" {{ old('project_manager') == "EH" ? 'selected' : '' }}>Esther Hestermann</option>
                        <option value="GP" {{ old('project_manager') == "GP" ? 'selected' : '' }}>Gabriele Pattas</option>
                        <option value="GW" {{ old('project_manager') == "GW" ? 'selected' : '' }}>Gaby Wiese</option>
                        <option value="JF" {{ old('project_manager') == "JF" ? 'selected' : '' }}>Janika Feld</option>
                        <option value="JB" {{ old('project_manager') == "JB" ? 'selected' : '' }}>Juliane Berek</option>
                        <option value="LH" {{ old('project_manager') == "LH" ? 'selected' : '' }}>Lara Helmcke</option>
                        <option value="LS" {{ old('project_manager') == "LS" ? 'selected' : '' }}>Lea Schurawitzki</option>
                        <option value="SM" {{ old('project_manager') == "SM" ? 'selected' : '' }}>Susanne Maisch</option>
                        <option value="SP" {{ old('project_manager') == "SP" ? 'selected' : '' }}>Sylvia Pichert</option>
                        <option value="FZ" {{ old('project_manager') == "FZ" ? 'selected' : '' }}>Frank Zander</option>
                        <option value="FL" {{ old('project_manager') == "FL" ? 'selected' : '' }}>Frank Lüttschwager</option>
                        <option value="SW" {{ old('project_manager') == "SW" ? 'selected' : '' }}>Saghar Walizada</option>
                        <option value="AN" {{ old('project_manager') == "AN" ? 'selected' : '' }}>Adrian Neumann</option>
                        <option value="AZ" {{ old('project_manager') == "AZ" ? 'selected' : '' }}>Anja Zietzschmann</option>
                        <option value="MB" {{ old('project_manager') == "MB" ? 'selected' : '' }}>Meike Bauermann</option>
                        <option value="SB" {{ old('project_manager') == "SB" ? 'selected' : '' }}>Sandra Bache</option>
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
                    <strong>Info:</strong>
                    <textarea class="form-control" style="height:75px" name="info">{{ $project->info }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="custom-select" name="status">
                        <option disabled>Wähle den Status aus</option>
                        <option value="Aktiv" {{ old('status') == "Aktiv" ? 'selected' : '' }}>Aktiv</option>
                        <option value="Inaktiv" {{ old('status') == "Inaktiv" ? 'selected' : '' }}>Inaktiv</option>
                        <option value="Gelöscht" {{ old('status') == "Gelöscht" ? 'selected' : '' }}>Gelöscht</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>

    </form>
@endsection
