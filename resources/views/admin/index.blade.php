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

                <p>Here you can edit the content of the dynamic pages.</p>

                <p><a class="btn btn-default" href="{{ route('admin.pages') }}" role="button">Manage Pages »</a></p>
            </div>
            <div class="col-md-4">
                <h2>Heading</h2>

                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula
                    porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut
                    fermentum massa justo sit amet risus.</p>

                <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
            </div>
        </div>
    </div>
    <!-- /container -->
@endsection