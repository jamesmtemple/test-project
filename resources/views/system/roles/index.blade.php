@extends('layouts.app')
    @section('section','Roles')
    @section('title','View Role List')

    @section('content')
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create New Role</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Scope</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($roles))
                @foreach($roles as $role)
                    <tr>
                      <td>{{ $role->name }}</td>
                      <td>{{ $role->scope }}</td>
                      <td>
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('roles.destroy', $role) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $role->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $role->id }}" action="{{ route('roles.destroy', $role) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="100%">There are no roles yet!</td>
                </tr>
              @endif
            </tbody>

          </table>
        </div>
    @endsection
