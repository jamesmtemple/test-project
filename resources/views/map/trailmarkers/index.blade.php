@extends('layouts.app')
    @section('section','Trailmarkers')
    @section('title','View Trailmarker List')

    @section('content')
        <a href="{{ route('trailmarkers.create') }}" class="btn btn-primary mb-3">Create New Trailmarker</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Trailmarker ID</th>
                  <th>Location</th>
                  <th>Nearest Postal</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($trailmarkers))
                @foreach($trailmarkers as $trailmarker)
                    <tr>
                      <td>{{ $trailmarker->name }}</td>
                      <td>{{ $trailmarker->location }}</td>
                      <td>{{ $trailmarker->nearest_postal->name }}</td>
                      <td>
                        <a href="{{ route('trailmarkers.edit', $trailmarker) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('subpostals.destroy', $trailmarker) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $trailmarker->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $trailmarker->id }}" action="{{ route('trailmarkers.destroy', $trailmarker) }}" method="POST" style="display: none;">
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
