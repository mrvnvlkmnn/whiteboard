<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Whiteboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/app.js" defer></script>
</head>
<body>

<div id="app" class="container">

    <div class="text-center" style="margin: 50px 0 50px 0;"><a href="{{url("projects")}}"><img
                src="{{asset("images/logo.png")}}" alt="Logo"></a><br>Whiteboard
    </div>

    @yield('content')
</div>

</body>
</html>
