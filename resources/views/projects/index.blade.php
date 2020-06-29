@extends('projects.layout')

@section('content')

    @if ($message = Session::get('Erfolgreich!'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <search-bar></search-bar>

@endsection
