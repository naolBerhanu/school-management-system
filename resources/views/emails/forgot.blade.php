@component('mail::message')
Hello {{$user->name}},

<p>Let's help you reset your password </p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Reset Your Password 
@endcomponent

<p>If you have trouble resetting your password please contact us. </p>

<p>Thanks,</p> <br>
{{config('app.name')}}
@endcomponent