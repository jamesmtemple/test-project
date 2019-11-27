@extends('layouts.app')
    @section('section','User Accounts')
    @section('title','Account Settings')
@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('account.settings') }}">
      @csrf
      
      <div class="form-group">
         <label for="abbr">Name</label>
         <input type="text" class="form-control" id="name" name="name" placeholder="Your name...." value="{{ old('name', Auth::user()->name) }}">
      </div>

      <hr />

      <div class="form-group">
          <label for="abbr">Discord ID</label>
          <input type="text" class="form-control" id="discord_id" name="discord_id" readonly value="{{ Auth::user()->discord_id }}">
      </div>

      <div class="form-group">
          <label for="abbr">Teamspeak ID</label>
          <input type="text" class="form-control" id="teamspeak_id" name="teamspeak_id" placeholder="Your Teamspeak ID...." value="{{ old('teamspeak_id', Auth::user()->teamspeak_id) }}">
      </div>

      <button class="btn btn-primary">Save</button>
    </form>
@endsection
