@extends('app')

@section('title')
    {{ $resource->exists ? 'Admin - Edit ' . $resource->original_filename : 'Admin - New Resource' }}
@endsection

@section('content')
    <div class="container">
        @include('partials.errors')

        @if(session('success'))
            <div class="alert alert-success">The resource was saved successfully.</div>
        @endif

        <form method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-12">
                    <label for="desc">Description</label>
                    <textarea name="desc" class="form-control" placeholder="A useful document...">{{ old('desc', $resource->desc) }}</textarea>
                </div>
            </div>

            @if(!$resource->exists)
                <br>

                <div class="row">
                    <div class="col-md-6">
                        <label for="original_filename">Upload File</label>
                        <input type="file" name="original_filename" class="form-control">
                    </div>
                </div>
            @endif

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="is_enabled">Enabled</label>
                    <input type="checkbox" name="is_enabled" value="1" {{ $resource->is_enabled ? 'checked' : '' }}>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="form-contol btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    <!-- /container -->
@endsection