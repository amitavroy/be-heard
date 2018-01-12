<!DOCTYPE html>
<html lang="en">
@include('errors.error-head')
<body>
<div class="cover"><h1>Access Denied! <small>Error 403</small></h1>
    <p class="lead">{{ $exception->getMessage() }}</p>
</div>
</body>
</html>
