<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>drinkList</title>

        {{-- react に変更があったとき自動で --}}
        @viteReactRefresh
        @vite(['resources/sass/app.scss', 'resources/js/productUpdate.jsx'])

    </head>

    <body class="antialiased">
        <div id="product_update"></div>
    </body>
</html>
