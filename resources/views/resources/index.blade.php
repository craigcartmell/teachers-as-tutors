@extends('app')

@section('title', 'Resources')

@section('breadcrumbs')
    {!! Breadcrumbs::render('resources') !!}
@endsection

@section('content')
    <div class="container table-responsive">
        @include('partials.errors')

        <a href="{{ route('resources.add') }}" class="btn btn-primary">Add New</a>
           <table class="table table-striped">
               <thead>
                <tr>
                    <th>Description</th>
                    <th>Original Filename</th>
                    <th>Size</th>
                    <th>Extension</th>
                    <th>Type</th>
                    <th>Created</th>
                    <th colspan="5">Updated</th>
                </tr>
               </thead>
               <tbody>
               @forelse($resources as $resource)
                   <tr>
                       <td>{{ $resource->desc }}</td>
                       <td>{{ $resource->original_filename }}</td>
                       <td>{{ $resource->size_formatted }}</td>
                       <td>{{ $resource->extension }}</td>
                       <td>{{ $resource->mime_type }}</td>
                       <td>{{ $resource->created_at->format('d/m/Y H:i:s') }} by {{ $resource->creator['name'] or 'System' }}</td>
                       <td>{{ $resource->updated_at->format('d/m/Y H:i:s') }} by {{ $resource->updater['name'] or 'System' }}</td>
                       <td><a href="{{ route('resources.download', ['id' => $resource->id]) }}" class="btn btn-default {{ !$resource->is_enabled ? 'disabled' : ''}}">Download</a></td>
                       <td><a href="{{ route('resources.enable', ['id' => $resource->id]) }}" class="btn btn-default">{{ $resource->is_enabled ? 'Disable' : 'Enable' }}</a></td>
                       <td><a href="{{ route('resources.edit', ['id' => $resource->id]) }}" class="btn btn-default">Edit</a></td>
                       <td><a href="{{ route('resources.delete', ['id' => $resource->id]) }}" class="btn btn-danger delete-record">Delete</a></td>

                   </tr>
               @empty
                   <tr>
                       <td colspan="10">There are currently no records available.</td>
                   </tr>
               @endforelse
               </tbody>
           </table>
    </div>
    <!-- /container -->
@endsection