@component('mail::message')
# One Last Step

Just need you to donfirm your email to prove that you're human. You get it, right? Cool.

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
    Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
