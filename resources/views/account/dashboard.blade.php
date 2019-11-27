@extends('layouts.app')
    @section('section','User Accounts')
    @section('title','Dashboard')
@section('content')
    <h3>Hey {{ Auth::user()->name }}!</h3>

    <h3>Meta Information</h3>

    <ul>
      <li><strong>Discord ID</strong> {{ Auth::user()->discord_id }}</li>
      <li><strong>Teamspeak ID</strong> {{ Auth::user()->teamspeak_id }}</li>
    </ul>

    <h3>Role Information</h3>

    <ul>
      @foreach(Auth::user()->roles as $role)
        <li>{{ $role->name }}</li>
      @endforeach
    </ul>
@endsection
