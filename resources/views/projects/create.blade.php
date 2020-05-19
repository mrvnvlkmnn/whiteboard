@extends('projects.layout')

@section('content')
    <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Add Project</h3>
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

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Studien-Nummer:</strong>
                    <input type="text" name="survey_number" value="{{ $year }}" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Programmierer:</strong>
                    <select class="select2 form-control" name="programmer[]" multiple>
                        <option value="DS" {{ in_array("DS", Arr::wrap(old('programmer'))) ? 'selected' : '' }}>Dennis Silberbach</option>
                        <option value="NS" {{ in_array("NS", Arr::wrap(old('programmer'))) ? 'selected' : '' }}>Nico Sorgenfrei</option>
                        <option value="MY" {{ in_array("MY", Arr::wrap(old('programmer'))) ? 'selected' : '' }}>Mawlid Yussuf</option>
                        <option value="MV" {{ in_array("MV", Arr::wrap(old('programmer'))) ? 'selected' : '' }}>Marvin Volkmann</option>
                        <option value="AG" {{ in_array("AG", Arr::wrap(old('programmer'))) ? 'selected' : '' }}>Antje Groth</option>
                        <option value="unknown" {{ in_array("unknown", Arr::wrap(old('programmer'))) ? 'selected' : '' }}>IT</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Projektleiter:</strong>
                    <select class="select2 form-control" name="project_manager[]" multiple="multiple">
                        <option value="DJ" {{ in_array("DJ", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Debora Jahnke</option>
                        <option value="EH" {{ in_array("EH", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Esther Hestermann</option>
                        <option value="GP" {{ in_array("GP", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Gabriele Pattas</option>
                        <option value="GW" {{ in_array("GW", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Gaby Wiese</option>
                        <option value="JF" {{ in_array("JF", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Janika Feld</option>
                        <option value="JB" {{ in_array("JB", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Juliane Berek</option>
                        <option value="LH" {{ in_array("LH", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Lara Helmcke</option>
                        <option value="LS" {{ in_array("LS", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Lea Schurawitzki</option>
                        <option value="SM" {{ in_array("SM", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Susanne Maisch</option>
                        <option value="SP" {{ in_array("SP", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Sylvia Pichert</option>
                        <option value="FZ" {{ in_array("FZ", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Frank Zander</option>
                        <option value="FL" {{ in_array("FL", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Frank Lüttschwager</option>
                        <option value="SW" {{ in_array("SW", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Saghar Walizada</option>
                        <option value="AN" {{ in_array("AN", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Adrian Neumann</option>
                        <option value="AZ" {{ in_array("AZ", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Anja Zietzschmann</option>
                        <option value="MB" {{ in_array("MB", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Meike Bauermann</option>
                        <option value="SB" {{ in_array("SB", Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>Sandra Bache</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:75px" name="detail">{{ old('detail') }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="custom-select" name="status" size="4">
                        <option value="Kick-Off"        {{ old('info') == "Kick-Off" ? 'selected' : '' }}>Kick-Off</option>
                        <option value="Programmierung"  {{ old('info') == "Programmierung" ? 'selected' : '' }}>Programmierung</option>
                        <option value="TL bei PL"       {{ old('info') == "TL bei PL" ? 'selected' : '' }}>Testlink bei Projektleiter</option>
                        <option value="Im Feld"   {{ old('info') == "Im Feld" ? 'selected' : '' }}>Im Feld</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Add Project</button>
            </div>
        </div>

    </form>
@endsection
