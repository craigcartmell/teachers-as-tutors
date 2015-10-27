<!DOCTYPE html>
<html>

@section('title', 'We\'re currently down for maintenance')

@include('partials.header')

<style>
    html, body {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        width: 100%;
        color: #000;
        display: table;
        font-weight: 300;
        font-family: 'Lato';
    }

    .container {
        text-align: center;
        display: table-cell;
        vertical-align: middle;
    }

    .content {
        text-align: center;
        display: inline-block;
    }

    .content img {
        width: 50%;
        margin-bottom: 12px;
    }
</style>

<body>
<div class="container">
    <div class="content">
        <div>
            <img src="{{ asset('img/teachers-as-tutors-logo.png') }}" title="{{ env('APP_NAME') }}"
                 alt="{{ env('APP_NAME') }}">
        </div>

        <br>

        <p>We're currently down for maintenance.</p>

        <p>For enquiries please email <a
                    href="mailto:{{ env('MAIL_TO') }}">{{ env('MAIL_TO') }}</a>.</p>
    </div>
</div>
</body>
</html>