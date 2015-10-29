@extends('app')

@section('title', 'Help')

@section('breadcrumbs')
    {!! Breadcrumbs::render('help') !!}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2>Navigation</h2>

                <p>
                    When logged in you will see a <span class="glyphicon glyphicon-user"></span> icon next to your
                    username. Click this to access the drop down menu.
                </p>

                <p>
                    From here you can access your profile, reports, calendar, resources and also manage the website.
                </p>

                <h2>Managing Pages</h2>

                <p>
                    To manage pages, go to the <a href="{{ route('admin.pages') }}">Manage Pages</a> section.
                </p>

                <p>From here you can edit the content of existing pages and also add new pages.</p>

                <p>
                    You may also disable a page which will temporarily hide it from users.
                </p>

                <p>To permanently delete a page, use the <button class="btn btn-danger">Delete</button> button.
                </p>

                <h2>Maintenance Mode</h2>
                <p>
                    Turning on maintenance mode will hide the website from users and generate a landing page.
                </p>

                <p>
                    Admin users will still be able to access the website as normal.
                </p>
            </div>
        </div>
    </div>
@endsection