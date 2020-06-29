@extends('projects.layout')

@section('content')

    @if ($message = Session::get('Erfolgreich!'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="text-center" style="margin-bottom: 50px">
        <h2>Verschicke eine Liste der Projekte</h2><br>
        <p>Wem möchtest du alles eine Liste mit den derzeitigen Studien schicken?</p>
        <p>Wähle unten aus!</p>
    </div>

        <div class="row createInput">
            <form method="POST" action="/sendMail" style="width: 100%;">
                @csrf
                <div style="width: 100%; display: flex; margin-bottom: 50px;">
                    <legend class="col-form-label col-sm-2 pt-0" style="margin-left: 360px;">Programmierer</legend>
                    <div style="position: relative; width: 100%; padding-right: 15px">
                        <label style="width: 500px">
                            <select class="select2 form-control" name="programmer[]" multiple>
                                @foreach(config('employees.mailsIT') as $key => $value)
                                    <option value="{{ $key }}" {{ in_array($key, Arr::wrap(old('programmer'))) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="form-group row" style="width: 100%; justify-content: center">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Weitere Nachrichten</label>
                    <div style="width: 500px">
                        <textarea class="form-control" name="moreText" rows="3"></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-info">E-Mail senden</button>
                </div>
            </form>
        </div>

@endsection
