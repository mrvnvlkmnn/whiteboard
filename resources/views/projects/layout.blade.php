<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Whiteboard</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">
    @livewireStyles
    <!-- Select2 CSS and JS -->
    <script src="{{ asset('js/app.js') }}" defer></script>

</head>
<body style="background: #EDF2F7">
<div>
    @livewire('nav-bar')
    <div class="container" style="max-width: 1500px">
        @if ($message = Session::get('Erfolgreich!'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @livewire('count-projects')
        @livewire('search-controller')
</div>
</div>
@livewireScripts
</body>
</html>
