<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <title>Cheatify</title>
    </head>
    <body>
        <div id="app">
            <cheatify-navbar/>
            <router-view></router-view>
        </div>
    </body>
    <script src="/js/app.js"></script>
</html>
