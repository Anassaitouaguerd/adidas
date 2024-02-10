@component('mail::message')
    <p>Hello {{ $user->name }},</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset your Password
    @endcomponent
    
    <p>If you have any questions, please feel free to contact us.</p>

    Thanks,<br/>
    {{ config('app.name') }}
@endcomponent
