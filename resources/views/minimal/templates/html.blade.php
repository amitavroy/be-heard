<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Be Heard</title>

    <link rel="stylesheet" href="{{url('css/app.css')}}">
</head>
<body>
    @include('minimal.partials.nav')
    <div class="container">
        @include('flash::message')
        @yield('content')
    </div>

    <script src="js/app.js"></script>
</body>
</html>