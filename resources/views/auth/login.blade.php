@extends('app')

@section('title', 'Login')

@section('breadcrumbs')
    {!! Breadcrumbs::render('login') !!}
@endsection

@section('hero_image')
    <img src="{{ asset('img/heroes/hero_login_spiral.jpg') }}" alt="{{ env('APP_NAME') }}">
@endsection

@section('content')
    <div class="container">

        @include('partials/errors')

        <form method="post">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="bob@smith.co.uk" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <label for="remember">Remember Me?</label>
                    <input type="checkbox" name="remember" value="1" class="form-control-static" {{ old('remember') ? 'checked' : '' }}>
                </div>
            </div>

            <br>

            <div>
                <input type="submit" name="submit" value="Login" class="form-control-static btn btn-primary">
            </div>
        </form>

        <br>

        <a href="{{ route('password.email') }}">Forgotten Password?</a>

    </div>
@endsection