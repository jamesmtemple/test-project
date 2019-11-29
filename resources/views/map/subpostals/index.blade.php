@extends('layouts.app')
    @section('section','Subpostals')
    @section('title','View Subpostal List')

    @section('content')
        <a href="{{ route('subpostals.create') }}" class="btn btn-primary mb-3">Create New Subpostal</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Postal ID</th>
                  <th>Subpostal ID</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($subpostals))
                @foreach($subpostals as $subpostal)
                    <tr>
                      <td>{{ $subpostal->postal->name }}</td>
                      <td>{{ $subpostal->name }}</td>
                      <td>
                        <a href="{{ route('subpostals.edit', $subpostal) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('subpostals.destroy', $subpostal) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $subpostal->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $subpostal->id }}" action="{{ route('subpostals.destroy', $subpostal) }}" method="POST" style="display: none;">
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
