@extends('app')

@section('title', 'Admin - Manage Pages')

@section('content')
    <div class="container table-responsive">
        <a href="{{ route('admin.pages.add') }}" class="btn btn-primary">Add New</a>
           <table class="table table-striped">
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
                   @include('partials.page-row', ['page' => $page])

                   @if(count($page->children))
                       <tr>
                           <th></th>
                           <th>Name</th>
                           <th>Uri</th>
                           <th>Created</th>
                           <th colspan="4">Updated</th>
                       </tr>
                       @foreach($page->children as $child)
                           @include('partials.page-row', ['page' => $child])
                       @endforeach
                   @endif
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