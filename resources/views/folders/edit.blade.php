@extends('app')

@section('title')
    {{ $folder->exists ? 'Edit ' . $folder->name : 'New Folder' }}
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('edit-folder', $folder) !!}
@endsection

@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">The folder was saved successfully.</div>
        @endif

        <form method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="row">
                <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name', $folder->name) }}">
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