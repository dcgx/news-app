<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ًApplication</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header class="bg-white border-b border-gray-300">
        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-between py-4">
                <div class="flex items-center">
                    <h1 class="text-lg font-semibold">Portal de Noticias NewsApp</h1>
                </div>
            </nav>
        </div>
    </header>
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>

</html>