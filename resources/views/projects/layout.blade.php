<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Whiteboard</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset("css/app.css") }}" rel="stylesheet">
    <!-- Select2 CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
    <script src="{{ asset("js/app.js") }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" defer></script>

    <style>
        .createInput{
            justify-content: center;
            align-items: center;
            display: flex;
        }
    </style>
</head>
<body style="background: #EDF2F7">
<div>
    <nav class="flex items-center justify-between flex-wrap bg-eae-dark p-2 shadow-md">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="/projects">
                <img src="{{ asset("images/eae_head.jpg") }}" width="80px" alt="Logo">
            </a>
            <!--<span class="font-semibold text-xl tracking-tight">Ears and Eyes</span>-->
        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
            <div class="text-sm lg:flex-grow">
                <button class="block mt-0 lg:inline-block lg:mt-0 text-eae-light hover:text-white mr-4">
                    Projekt hinzufügen
                </button>
                <a href="sendMail" class="block mt-0 lg:inline-block lg:mt-0 text-eae-light hover:text-white mr-4">
                    E-Mail senden
                </a>
            </div>
        </div>
    </nav>

        @yield('content')
</div>

</body>
</html>
