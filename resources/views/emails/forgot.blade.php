@component('mail::message')
    Hello{{ $user->name }},
    <p>We understand it happen</p>
    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset your password
    @endcomponent
    <p>In case you have any issue recovering your password, pleasr contact us</p>
    {{ config('app.name') }}
@endcomponent
