<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ًApplication</title>
    @vite('resources/sass/app.scss')
</head>

<body>
    <header class="bg-white border-bottom border-gray-300">
        <div class="container px-4">
            <nav class="navbar navbar-expand-lg navbar-light py-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Portal de Noticias NewsApp</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto"></ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <div id="app"></div>
    @vite('resources/js/app.js')

</body>

</html>