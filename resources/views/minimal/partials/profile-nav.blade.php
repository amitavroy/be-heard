<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="{{(Route::is('profile')) ? 'active' : ''}}">
        <a href="{{route('profile')}}">My profile</a>
    </li>

    <li role="presentation" class="{{(Route::is('profile.recent-activity')) ? 'active' : ''}}">
        <a href="{{route('profile.recent-activity')}}">Recent activity</a>
    </li>

    <li role="presentation" class="{{(Route::is('profile.change-password')) ? 'active' : ''}}">
        <a href="{{route('profile.change-password')}}">Change password</a>
    </li>

    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
</ul>