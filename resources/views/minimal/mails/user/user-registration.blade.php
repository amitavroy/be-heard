@component('mail::message')
    # Registration to {{ config('app.name') }} done.

    Your registration is successful. Now you can login to the application and use it.

    Thanks,
    {{ config('app.name') }}
@endcomponent