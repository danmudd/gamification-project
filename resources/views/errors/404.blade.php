@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
        404 - Oops!
        @endcomponent
    </div>

   <div class="row">
       <div class="col-md-12">
           <h2>It seems we can't find what you're looking for.</h2>
           <h3>Click <a href="{{ route('home') }}">here</a> to return home or click <a href="mailto:contact@teamdog.io">here</a> to contact us.</h3>
       </div>
   </div>
@endsection