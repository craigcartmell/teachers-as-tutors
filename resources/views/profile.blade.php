@extends('app')

@section('title', 'My Profile')

@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">Your profile was updated successfully.</div>
        @endif

        <form method="post">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-control" placeholder="Bob Smith">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" placeholder="bob@smith.co.uk">
                </div>

                <div class="col-md-6">
                    <label for="email_confirmation">Confirm Email</label>
                    <input type="email" name="email_confirmation" value="{{ old('email_confirmation', auth()->user()->email) }}" class="form-control" placeholder="bob@smith.co.uk">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="form-contol btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->
@endsection