<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Planned power grid disconnections in Macedonia">

        <title inertia>{{ config('app.name') }}</title>

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead

        <style>
            body {
                overflow:   scroll;
            }

            ::-webkit-scrollbar {
                width: 0px;
                background: transparent; /* make scrollbar transparent */
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
