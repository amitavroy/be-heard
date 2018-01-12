<!DOCTYPE html>
<html lang="en">
@include('errors.error-head')
<body>
<div class="cover">
    <h1>Bad request <small>Error 400</small></h1>
    <p class="lead">{{ $exception->getMessage() }}</p></div>
</body>
</html>
