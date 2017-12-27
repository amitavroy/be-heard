@component('mail::message')
    # You are invited to join {{ config('app.name') }}

    {{ $data['user']->name  }} has invited you to join. You can click on the button below and register.

    If you are not able to view the button, you can copy this url and paste it in the browser as well.

    {{ route('register.invited', $data['invite']->token) }}

    Thanks,
    {{ config('app.name') }}
@endcomponent