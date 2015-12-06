@extends('app')

@section('title', 'Folders')

@section('breadcrumbs')
    {!! Breadcrumbs::render('folders') !!}
@endsection

@section('content')
    <div class  ="container">
        @include('partials.errors')

        <span class="text-left">
            <a href="{{ route('folders.add') }}" class="btn btn-primary">Add New</a>
        </span>
    </div>

    <div class="container table-responsive">
           <table class="table table-striped">
               <thead>
                <tr>
                    <th>Name</th>
                    <th>Resources</th>
                    <th>Created</th>
                    <th colspan="5">Updated</th>
                </tr>
               </thead>
               <tbody>
               @forelse($folders as $folder)
                   <tr>
                       <td>{{ $folder->name }}</td>
                       <td><a href="{{ route('resources', ['folder_id' => $folder->getKey()]) }}">{{ count($folder->resources) }} items</a></td>
                       <td>{{ $folder->created_at->format('d/m/Y H:i:s') }} by {{ $folder->creator['name'] or 'System' }}</td>
                       <td>{{ $folder->updated_at->format('d/m/Y H:i:s') }} by {{ $folder->updater['name'] or 'System' }}</td>
                       <td><a href="{{ route('folders.edit', ['id' => $folder->getKey()]) }}" class="btn btn-default">Edit</a></td>
                       <td><a href="{{ route('folders.delete', ['id' => $folder->getKey()]) }}" class="btn btn-danger delete-record">Delete</a></td>

                   </tr>
               @empty
                   <tr>
                       <td colspan="10">There are currently no records available.</td>
                   </tr>
               @endforelse
               </tbody>
           </table>
    </div>
@endsection