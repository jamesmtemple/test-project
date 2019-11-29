@extends('layouts.app')
    @section('section','Postals')
    @section('title','View Postal List')

    @section('content')
        <a href="{{ route('postals.create') }}" class="btn btn-primary mb-3">Create New Postal</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Common Name</th>
                  <th>ID</th>
                  <th>Fire Station</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($postals))
                @foreach($postals as $postal)
                    <tr>
                      <td>{{ $postal->common_name }}
                      <td>{{ $postal->name }}</td>
                      <td>{{ $postal->station->name }}</td>
                      <td>
                        <a href="{{ route('postals.edit', $postal) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('postals.destroy', $postal) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $postal->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $postal->id }}" action="{{ route('postals.destroy', $postal) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="100%">There are no departments yet!</td>
                </tr>
              @endif
            </tbody>

          </table>
        </div>
    @endsection
