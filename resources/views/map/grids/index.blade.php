@extends('layouts.app')
    @section('section','Grids')
    @section('title','View Grid List')

    @section('content')
        <a href="{{ route('grids.create') }}" class="btn btn-primary mb-3">Create New Grid</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Grid ID</th>
                  <th>Nearest Dock</th>
                  <th>Nearest Helipad</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($grids))
                @foreach($grids as $grid)
                    <tr>
                      <td>{{ $grid->name }}</td>
                      <td>Postal {{ $grid->nearest_dock->name }}</td>
                      <td>Postal {{ $grid->nearest_helipad->name }}</td>
                      <td>
                        <a href="{{ route('grids.edit', $grid) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('grids.destroy', $grid) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $grid->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $grid->id }}" action="{{ route('grids.destroy', $grid) }}" method="POST" style="display: none;">
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
