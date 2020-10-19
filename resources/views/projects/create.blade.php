@extends('projects.layout')

@section('content')
        <div>
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
                    <div class="col-xs-12 col-sm-12 col-md-12 createInput">
                        <div class="form-group">
                            <label>
                                <strong>Studien-Nummer:</strong>
                                <input type="text" name="survey_number" value="{{ old('survey_number', $year) }}" class="form-control" style="width: 500px;">
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 createInput">
                        <div class="form-group">
                            <strong>Programmierer:</strong>
                            <br>
                            <label style="width: 500px">
                                <select class="select2 form-control" name="programmer[]" multiple>
                                    @foreach(config('employees.programmer') as $key => $value)
                                        <option value="{{ $key }}" {{ in_array($key, Arr::wrap(old('programmer'))) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 createInput">
                        <div class="form-group">
                            <strong>Projektleiter:</strong>
                            <br>
                            <label style="width: 500px">
                                <select class="select2 form-control" name="project_manager[]" multiple="multiple">
                                    @foreach(config('employees.project_manager') as $key => $value)
                                        <option value="{{ $key }}" {{ in_array($key, Arr::wrap(old('project_manager'))) ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 createInput">
                        <div class="form-group">
                            <label style="width: 500px">
                                <strong>Detail:</strong>
                                <textarea class="form-control" style="height:75px" name="detail">{{ old('detail') }}</textarea>
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 createInput">
                        <div class="form-group">
                            <label>
                                <strong>geplanter Feldstart:</strong>
                                <input class="form-control" type="date" name="feldstart" value="{{ old('feldstart') }}" style="width: 500px;">
                            </label>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 createInput">
                        <div class="form-group">
                            <label style="width: 500px">
                                <strong>Status:</strong>
                                <select class="custom-select" name="status" size="4">
                                    <option value="Kick-Off"        {{ old('status') == "Kick-Off" ? 'selected' : '' }}>Kick-Off</option>
                                    <option value="Programmierung"  {{ old('status') == "Programmierung" ? 'selected' : '' }}>Programmierung</option>
                                    <option value="TL bei PL"       {{ old('status') == "TL bei PL" ? 'selected' : '' }}>Testlink bei Projektleiter</option>
                                    <option value="Im Feld"         {{ old('status') == "Im Feld" ? 'selected' : '' }}>Im Feld</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Projekt hinzufügen</button>
                    </div>
                </div>
            </form>
    </div>
@endsection
