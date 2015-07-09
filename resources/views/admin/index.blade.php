@extends('app')

@section('title', 'Admin')

@section('content')
    <div class="container">
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-md-4">
                <h2>Manage Users</h2>

                <p>Here you can create, edit and delete users. You can also manage the level of access they are allowed.</p>

                <p><a class="btn btn-default" href="{{ route('admin.users') }}" role="button">Manage Users »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Manage Pages</h2>

                <p>Here you can edit the content of the existing pages as well as creating new ones.</p>

                <p><a class="btn btn-default" href="{{ route('admin.pages') }}" role="button">Manage Pages »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Manage Resources</h2>

                <p>Here you can manage resources such as uploaded pupil reports and billing information.</p>

                <p><a class="btn btn-default" href="{{ route('admin.resources') }}" role="button">Manage Resources »</a></p>
            </div>
        </div>
    </div>
    <!-- /container -->
@endsection