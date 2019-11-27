@extends('layouts.app')
    @section('section','Unit Types')
    @section('title','View Unit Type List')

    @section('content')
        <a href="{{ route('types.create') }}" class="btn btn-primary mb-3">Create New Unit Type</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Abbreviation</th>
                  <th>Scope</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($types))
                @foreach($types as $type)
                    <tr>
                      <td>{{ $type->name }}</td>
                      <td>{{ $type->abbr }}</td>
                      <td>{{ $type->department->name }}</td>
                      <td>
                        <a href="{{ route('apparatus.edit', $type) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('apparatus.destroy', $type) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $type->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $type->id }}" action="{{ route('apparatus.destroy', $type) }}" method="POST" style="display: none;">
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
