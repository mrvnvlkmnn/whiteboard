<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Whiteboard</title>
    <!-- Bootstrap CSS -->
    <link href="/css/app.css" rel="stylesheet">
    <!-- Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>

</head>
<body>

<div id="app" class="container" style="max-width: 1500px">

    <div class="text-center" style="margin: 50px 0 50px 0;"><a href="{{url("projects")}}"><img
                src="{{asset("images/eae_logo.png")}}" width="1110px" alt="Logo"></a>
                <br>
                Whiteboard
    </div>

    @yield('content')
</div>

</body>
</html>
