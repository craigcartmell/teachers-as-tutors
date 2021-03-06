@extends('app')

@section('title', 'Manage Users')

@section('breadcrumbs')
    {!! Breadcrumbs::render('users') !!}
@endsection

@section('content')
    <div class="container table-responsive">
        <a href="{{ route('admin.users.add') }}" class="btn btn-primary">Add New</a>
           <table class="table table-striped">
               <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Created</th>
                    <th colspan="4">Updated</th>
                </tr>
               </thead>
               <tbody>
               @forelse($users as $user)
               <tr>
                   <td>{{ $user->name }}</td>
                   <td>{{ $user->email }}</td>
                   <td>{{ $user->permission['name'] }}</td>
                   <td>{{ $user->created_at->format('d/m/Y H:i:s') }} by {{ $user->creator['name'] or 'System' }}</td>
                   <td>{{ $user->updated_at->format('d/m/Y H:i:s') }} by {{ $user->updater['name'] or 'System' }}</td>
                   <td><a href="{{ route('admin.users.enable', ['id' => $user->id]) }}" class="btn btn-default">{{ $user->is_enabled ? 'Disable' : 'Enable' }}</a></td>
                   <td><a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn btn-default">Edit</a></td>
                   <td><a href="{{ route('admin.users.delete', ['id' => $user->id]) }}" class="btn btn-danger delete-record">Delete</a></td>
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