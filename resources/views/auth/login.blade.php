@extends('app')

@section('title', 'Login')

@section('content')
    <div class="container">

        @include('partials/errors')

        <form method="post">
            {!! csrf_field() !!}

            <div>
                <label for="email" class="label label-info">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="bob@smith.co.uk" class="form-control">
            </div>

            <div>
                <label for="password" class="label label-info">Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control">
            </div>

            <div>
                <label for="remember" class="label label-info">Remember Me?</label>
                <input type="checkbox" name="remember" value="1" {{ old('remember') }} class="form-control-static">
            </div>

            <div>
                <input type="submit" name="submit" value="Login" class="form-control-static btn btn-primary">
            </div>
        </form>

        <div>
            <a href="{{ route('password.email') }}">Forgotten Password?</a>
        </div>
    </div>
@endsection