<!DOCTYPE html>
<html lang="en">
@include('errors.error-head')
<body>
<div class="cover"><h1>Not found <small>Error 404</small></h1>
    <p class="lead">{{ $exception->getMessage() }}</p>
</div>
</body>
</html>
