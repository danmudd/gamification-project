@extends('layouts.master')

@push('title') :: Login @endpush

@section('content')
    {!!  BootForm::open()->action(route('login'))->addClass('form-signin') !!}
        <h2>Hello! <br /><small>Welcome to the Team Dog Peer Review Platform. </small></h2>
        {!! BootForm::text('Username or email address', 'username')->placeholder('Username or email address')->hideLabel() !!}
        {!! BootForm::password('Password', 'password')->placeholder('Password')->hideLabel() !!}
        {!! Bootform::submit('Login')->addClass('btn-lg btn-primary btn-block') !!}
    {!! BootForm::close() !!}
@stop

@push('styles')
<style>
body
{
padding-top: 40px;
background-color: #eee;
}

.form-signin
{
max-width: 330px;
padding: 10% 15px 15px;
margin: 0 auto;
}

.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin .checkbox {
font-weight: normal;
}
.form-signin .form-control
{
position: relative;
font-size: 16px;
height: auto;
padding: 10px;
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}

.form-signin .form-group
{
    margin-bottom: 0;
}

.form-signin .form-control:focus
{
z-index: 2;
}

.form-signin input[type="text"]
{
margin-bottom: -1px;
border-bottom-left-radius: 0;
border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
margin-bottom: 10px;
border-top-left-radius: 0;
border-top-right-radius: 0;
}

.navbar-toggle
{
display: none;
}
</style>
@endpush