<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:image" content="/og-image.jpg">
    <meta property="og:image:width" content="279">
    <meta property="og:image:height" content="279">
    <meta property="og:title" content="App Tasques ">
    <meta property="og:description" content="The best way to start developing with tasques">
    <meta property="og:url" content="https://tasks.mohamedelatfi.scool.cat/">
    <meta property="og:image" content="https://tasks.mohamedelatfi.scool.cat/img/og-image.jpg">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
   {{--<link rel="manifest" href="/manifest.json">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <style>
        [v-cloak] { display: none }

    </style>
</head>
<body>
<div id="app" v-cloak>
    @yield('content')
</div>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>