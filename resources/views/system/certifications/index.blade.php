@extends('layouts.app')
    @section('section','Certifications')
    @section('title','View Certification List')

    @section('content')
        <a href="{{ route('certifications.create') }}" class="btn btn-primary mb-3">Create New Certification</a>

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
              @if(count($certifications))
                @foreach($certifications as $certification)
                    <tr>
                      <td>{{ $certification->name }}</td>
                      <td>{{ $certification->abbr }}</td>
                      <td>{{ $certification->scope }}</td>
                      <td>
                        <a href="{{ route('certifications.edit', $certification) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('certifications.destroy', $certification) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $certification->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $certification->id }}" action="{{ route('certifications.destroy', $certification) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="100%">There are no certifications yet!</td>
                </tr>
              @endif
            </tbody>

          </table>
        </div>
    @endsection
