@extends('layouts.app')
    @section('section','User Accounts')
    @section('title','Login')
@section('content')
    Welcome to the MidWest Roleplay Computer Aided Dispatch System. We use Discord to authenticate our users. Please click the button below to authenticate now.
    <hr />
    <a href="{{ route('login.redirect') }}" class="btn btn-primary">Sign in with Discord</a>
@endsection
