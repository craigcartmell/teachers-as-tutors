@extends('app')

@section('title', 'Reset Password')

@section('content')
    <div class="container">

        <h1>Reset Password</h1>

        @include('partials/errors')

        {{ session('status') }}
        
        <form method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email" class="label label-info">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="bob@smith.co.uk" class="form-control">
            </div>

            <div>
                <label for="password" class="label label-info">Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control">
            </div>

            <div>
                <label for="password_confirmation" class="label label-info">Confirm Password</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
            </div>

            <div>
                <input type="submit" name="submit" value="Reset Password" class="form-control-static">
            </div>
        </form>
    </div>
@endsection