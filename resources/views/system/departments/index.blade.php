@extends('layouts.app')
    @section('section','Departments')
    @section('title','View Department List')

    @section('content')
        <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">Create New Department</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Abbreviation</th>
                  <th>Type</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($departments))
                @foreach($departments as $department)
                    <tr>
                      <td>{{ $department->name }}</td>
                      <td>{{ $department->abbr }}</td>
                      <td>{{ $department->type_text }}</td>
                      <td>
                        <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('departments.destroy', $department) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $department->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $department->id }}" action="{{ route('departments.destroy', $department) }}" method="POST" style="display: none;">
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
