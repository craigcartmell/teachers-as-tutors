@extends('app')

@section('title', 'Reset Password')

@section('breadcrumbs')
    {!! Breadcrumbs::render('reset-password') !!}
@endsection

@section('content')
    <div class="container">
        @include('partials/errors')

        {{ session('status') }}
        
        <form method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="bob@smith.co.uk" class="form-control">
            </div>

            <br>

            <div>
                <label for="password">Password</label>
                <input type="password" name="password" value="{{ old('password') }}" class="form-control">
            </div>

            <br>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
            </div>

            <br>

            <div>
                <input type="submit" name="submit" value="Reset Password" class="form-control-static btn btn-primary">
            </div>
        </form>
    </div>
@endsection