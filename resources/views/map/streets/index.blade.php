@extends('layouts.app')
    @section('section','Streets')
    @section('title','View Street List')

    @section('content')
        <a href="{{ route('streets.create') }}" class="btn btn-primary mb-3">Create New Street</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($streets))
                @foreach($streets as $street)
                    <tr>
                      <td>{{ $street->name }}</td>
                      <td>
                        <a href="{{ route('streets.edit', $street) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('streets.destroy', $street) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $street->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $street->id }}" action="{{ route('streets.destroy', $street) }}" method="POST" style="display: none;">
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
