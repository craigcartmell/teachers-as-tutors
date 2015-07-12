<p>Hi {{ $user->name }},</p>

<p>You have been invited to join {{ env('APP_NAME') }}.</p>

<p>Please <a href="{{ url('password/reset/'.$token) }}">click here</a> to set your password.</p>

<p>Regards,</p>

<p>{{ env('APP_NAME') }}</p>