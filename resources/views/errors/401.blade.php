@extends('app')

@section('title', 'Unauthorised')

@section('content')
    <div class="container">
       <div class="alert alert-danger">
           You don't have permission to view this page.
       </div>
    </div>
    <!-- /container -->
@endsection