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
   <link rel="manifest" href="/manifest.json">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <style>
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            content: "";
            display: block;
            width: 72px;
            height: 72px;
            position: absolute;
            top: 50%;
            left: 50%;
            background-image: url('data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJsb2FkZXItMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiCiAgIHdpZHRoPSI3MnB4IiBoZWlnaHQ9IjcycHgiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNDAgNDAiIHhtbDpzcGFjZT0icHJlc2VydmUiPgogIDxwYXRoIG9wYWNpdHk9IjAuMiIgZmlsbD0iIzAwNzdlOCIgZD0iTTIwLjIwMSw1LjE2OWMtOC4yNTQsMC0xNC45NDYsNi42OTItMTQuOTQ2LDE0Ljk0NmMwLDguMjU1LDYuNjkyLDE0Ljk0NiwxNC45NDYsMTQuOTQ2CiAgICBzMTQuOTQ2LTYuNjkxLDE0Ljk0Ni0xNC45NDZDMzUuMTQ2LDExLjg2MSwyOC40NTUsNS4xNjksMjAuMjAxLDUuMTY5eiBNMjAuMjAxLDMxLjc0OWMtNi40MjUsMC0xMS42MzQtNS4yMDgtMTEuNjM0LTExLjYzNAogICAgYzAtNi40MjUsNS4yMDktMTEuNjM0LDExLjYzNC0xMS42MzRjNi40MjUsMCwxMS42MzMsNS4yMDksMTEuNjMzLDExLjYzNEMzMS44MzQsMjYuNTQxLDI2LjYyNiwzMS43NDksMjAuMjAxLDMxLjc0OXoiLz4KICA8cGF0aCBmaWxsPSIjMDA3N2U4IiBkPSJNMjYuMDEzLDEwLjA0N2wxLjY1NC0yLjg2NmMtMi4xOTgtMS4yNzItNC43NDMtMi4wMTItNy40NjYtMi4wMTJoMHYzLjMxMmgwCiAgICBDMjIuMzIsOC40ODEsMjQuMzAxLDkuMDU3LDI2LjAxMywxMC4wNDd6Ij4KICAgIDxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZVR5cGU9InhtbCIKICAgICAgYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIgogICAgICB0eXBlPSJyb3RhdGUiCiAgICAgIGZyb209IjAgMjAgMjAiCiAgICAgIHRvPSIzNjAgMjAgMjAiCiAgICAgIGR1cj0iMC41cyIKICAgICAgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiLz4KICAgIDwvcGF0aD4KICA8L3N2Zz4=');
        }
    </style>
</head>
<body>
<div id="app" v-cloak>
    @yield('content')
</div>
<script src="{{mix('/js/app.js')}}"></script>
</body>
</html>