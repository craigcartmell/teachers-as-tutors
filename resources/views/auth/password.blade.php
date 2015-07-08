@extends('app')

@section('title', 'Forgotten Password')

@section('content')
    <div class="container">

        @include('partials/errors')

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="post">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="bob@smith.co.uk" class="form-control">
                </div>
            </div>

            <br>

            <div>
                <input type="submit" name="submit" value="Send Password Reset Link" class="form-control-static btn btn-primary">
            </div>
        </form>
    </div>
@endsection