@extends('layouts.master')

@section('precontent')
    @include('partials.sidebar')
@stop

@push('styles')
<style>
    @media (min-width: 992px)
    {
        body
        {
            padding-left: 300px;
        }

        .navbar-brand
        {
            float: left;
        }
    }
</style>
@endpush