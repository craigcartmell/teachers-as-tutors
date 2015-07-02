@extends('app')

@section('title', 'Admin - Manage Pages')

@section('content')
    <div class="container">
        <a href="{{ route('admin.pages.add') }}" class="btn btn-primary">Add New</a>
           <table class="table table-responsive table-striped">
               <thead>
                <tr>
                    <th>Name</th>
                    <th>Uri</th>
                    <th>Created</th>
                    <th colspan="4">Updated</th>
                </tr>
               </thead>
               <tbody>
               @forelse($pages as $page)
                   <tr>
                       <td>{{ $page->name }}</td>
                       <td><a href="{{ url($page->uri) }}" target="_blank">{{ url($page->uri) }}</a></td>
                       <td>{{ $page->created_at->format('d/m/Y H:i:s') }} by {{ $page->creator['name'] or 'System' }}</td>
                       <td>{{ $page->updated_at->format('d/m/Y H:i:s') }} by {{ $page->updater['name'] or 'System' }}</td>
                       <td><a href="{{ route('admin.pages.enable', ['id' => $page->getKey()]) }}" class="btn btn-default">{{ $page->is_enabled ? 'Disable' : 'Enable' }}</a></td>
                       <td><a href="{{ route('admin.pages.edit', ['id' => $page->getKey()]) }}" class="btn btn-default">Edit</a></td>
                       <td><a href="{{ route('admin.pages.delete', ['id' => $page->getKey()]) }}" class="btn btn-danger delete-record">Delete</a></td>
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