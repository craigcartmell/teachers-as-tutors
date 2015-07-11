@extends('app')

@section('title', 'My Reports')

@section('content')
    <div class="container table-responsive">
        <a href="{{ route('reports.add') }}" class="btn btn-primary">Add New</a>
           <table class="table table-striped">
               <thead>
                <tr>
                    <th>Name</th>
                    <th>Created</th>
                    <th colspan="4">Updated</th>
                </tr>
               </thead>
               <tbody>
               @forelse($reports as $report)
                   <tr>
                       <td>{{ $report->name }}</td>
                       <td>{{ $report->created_at->format('d/m/Y H:i:s') }} by {{ $report->creator['name'] or 'System' }}</td>
                       <td>{{ $report->updated_at->format('d/m/Y H:i:s') }} by {{ $report->updater['name'] or 'System' }}</td>
                       <td><a href="{{ route('reports.enable', ['id' => $report->id]) }}" class="btn btn-default">{{ $report->is_enabled ? 'Disable' : 'Enable' }}</a></td>
                       <td><a href="{{ route('reports.edit', ['id' => $report->id]) }}" class="btn btn-default">Edit</a></td>
                       <td><a href="{{ route('reports.delete', ['id' => $report->id]) }}" class="btn btn-danger delete-record">Delete</a></td>

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