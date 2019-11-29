@extends('layouts.app')
    @section('section','Stations')
    @section('title','View Station List')

    @section('content')
        <a href="{{ route('stations.create') }}" class="btn btn-primary mb-3">Create New Station</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($stations))
                @foreach($stations as $station)
                    <tr>
                      <td>{{ $station->name }}</td>
                      <td>{{ $station->location }}</td>
                      <td>
                        <a href="{{ route('stations.edit', $station) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('stations.destroy', $station) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $station->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $station->id }}" action="{{ route('stations.destroy', $station) }}" method="POST" style="display: none;">
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
