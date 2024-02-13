@component('mail::message')
    <p>Hello {{ $user->name }},</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset your Password
    @endcomponent
    
    If you have any questions, please feel free to contact us.

    Thanks,
    {{ config('app.name') }}
@endcomponent
