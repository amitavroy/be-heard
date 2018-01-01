<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Be Heard</title>

    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <script>
      var CKEDITOR_BASEPATH = '/config/';
      window.Laravel = { csrfToken: '{{ csrf_token() }}', basePath: '{{ url("/") }}/' }
    </script>
</head>
<body>
    <div id="app">
        @include('minimal.partials.nav')
        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>
        <conversation-add></conversation-add>
    </div>

    <script src="{{url('js/app.js')}}"></script>
</body>
</html>
