@extends('projects.layout')

@section('content')
    <div id="app" class="container" style="max-width: 1500px">
    @if ($message = Session::get('Erfolgreich!'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

        @livewire('search-controller', [])
    </div>
@endsection
