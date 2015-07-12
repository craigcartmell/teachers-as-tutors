@extends('app')

@section('title')
    Contact Us
@endsection

@section('hero_text', '')

@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('captcha_errors'))
            <div class="alert alert-danger">
                @foreach(session('captcha_errors') as $captcha_error)
                    <p>reCAPTCHA error: {{ $captcha_error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">Thanks! We'll be in touch as soon as possible.</div>
        @endif

        <form method="post">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Bob Smith" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="bob@smith.co.uk" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-12">
                    <textarea name="body" class="form-control" placeholder="Get in touch..." rows="10">{{ old('body') }}</textarea>
                </div>
            </div>

            <br>

            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_KEY') }}"></div>

            <br>

            <div>
                <input type="submit" name="submit" value="Send" class="form-control-static btn btn-primary">
            </div>
        </form>
    </div>

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <!-- /container -->
@endsection