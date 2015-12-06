@extends('app')

@section('title', 'Resources')

@section('breadcrumbs')
    {!! Breadcrumbs::render('resources') !!}
@endsection

@section('content')
    <div class  ="container">
        @include('partials.errors')

        <span class="text-left">
            <a href="{{ route('resources.add') }}" class="btn btn-primary">Add New</a>
            <a href="{{ route('folders') }}" class="btn btn-default">Manage Folders</a>
        </span>

        <form class="text-right">
            <span>
                <label for="folder_id">Folder: </label>
                <select id="folder_id" name="folder_id" class="text-right">
                    <option value="0">-- Please Select --</option>
                    @foreach($folders as $folder)
                        <option value="{{ $folder->getKey() }}" {{ $folder->getKey() == $folder_id ? 'selected' : '' }}>{{ $folder->name }} ({{ count($folder->resources) }})</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-default btn-xs" value="Filter">
                <a href="{{ route('resources') }}" class="btn btn-default btn-xs">Reset</a>
            </span>
        </form>
    </div>

    <div class="container table-responsive">
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