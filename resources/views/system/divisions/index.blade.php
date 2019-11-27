@extends('layouts.app')
    @section('section','Divisions')
    @section('title','View Division List')

    @section('content')
        <a href="{{ route('divisions.create') }}" class="btn btn-primary mb-3">Create New Division</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Abbreviation</th>
                  <th>Department</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($divisions))
                @foreach($divisions as $division)
                    <tr>
                      <td>{{ $division->name }}</td>
                      <td>{{ $division->abbr }}</td>
                      <td>{{ $division->department_name }}</td>
                      <td>
                        <a href="{{ route('divisions.edit', $division) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('divisions.destroy', $division) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $division->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $division->id }}" action="{{ route('divisions.destroy', $division) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="100%">There are no divisions yet!</td>
                </tr>
              @endif
            </tbody>

          </table>
        </div>
    @endsection
