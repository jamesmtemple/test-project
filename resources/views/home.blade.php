@extends('layouts.app')
    @section('section','User Accounts')
    @section('title','User Account Dashboard')

    @section('content')
        <h3>Hey {{ Auth::user()->name }}!</h3>

        @if(Auth::user()->primary_role_id)
          <p>You are a member of {{ Auth::user()->primary_role->department->name }}, with a rank of {{ Auth::user()->primary_role->name }}.</p>

          <p>The following subdivisions are available to you. If you have a rank it will be displayed in parenthesis next to the division.</p>
          <ul>
            @foreach(Auth::user()->primary_role->department->divisions as $division)
              <li>{{ $division->name }} @if($division->isMember(Auth::user())) ({{ $division->getRole(Auth::user())->name }}) @endif</li>
            @endforeach
          </ul>

            <p>The following certifications are available to you. If you have the certification, look for an "X" next to it.</p>
            <ul>
              @foreach(Auth::user()->primary_role->department->certifications as $certification)
                <li>{{ $certification->name }} @if(Auth::user()->has($certification->name)) (X) @endif</li>
              @endforeach
            </ul>
          @endif

          <p>Here is all the departments that you are a part of:</p>

          @foreach(Auth::user()->roles->where('type',1) as $role)
            <li>{{ $role->department->name }}({{ $role->name}})</li>
          @endforeach

          <hr />

          <p><strong>Note:</strong> The options below are SOLELY FOR TESTING. They show what can be seen on the CAD for each user type. The final version of this cad will not be split on different pages. (IE, /leo,/fire,/civ). The user will be able to see the system at / after selecting which agency they want to patrol with.</p>

          <a href="{{ route('civ') }}" class="btn btn-secondary">Civilian Options</a>
          <a href="{{ route('comms') }}" class="btn btn-secondary">Comms Options</a>
          <a href="{{ route('fire') }}" class="btn btn-secondary">Fire Options</a>
          <a href="{{ route('leo') }}" class="btn btn-secondary">LEO Options</a>

    @endsection
