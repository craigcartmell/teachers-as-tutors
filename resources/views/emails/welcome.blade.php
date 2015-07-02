<p>Hi {{ $user->name }},</p>

<p>You have been invited to join {{ env('APP_NAME') }}.</p>

<p>Please click this link to set your password: {{ url('password/reset/'.$token) }}</p>

<p>Regards,</p>

<p>{{ env('APP_NAME') }}</p>