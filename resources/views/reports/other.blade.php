@extends('app')

@section('title')
    {{  'Other Reports' }}
@endsection

@section('breadcrumbs')
    {!! Breadcrumbs::render('reports-other') !!}
@endsection

@include('reports.partials.records')