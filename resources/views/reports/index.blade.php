@extends('app')

@section('title')
    {{  'My Reports' }}
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('reports') !!}
@endsection

@include('reports.partials.records')