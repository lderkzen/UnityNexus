<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @inertiaHead
    </head>
    <body class="bg-fixed bg-cover bg-no-repeat bg-center text-white">
        <section class="h-screen">
            <div id="app" class="min-h-full" data-page="{{ json_encode($page) }}"></div>
        </section>
    </body>
</html>
