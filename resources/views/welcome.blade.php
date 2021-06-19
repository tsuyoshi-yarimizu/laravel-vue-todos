<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Vue Laravel SPA') }}</title>
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
</head>
<body>
  <div id="app">
    <router-view></router-view>
  </div>
  <script src="{{ mix('/js/app.js') }}" defer></script>
</body>
</html>
