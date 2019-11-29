@extends('layouts.app')
    @section('section','Response Plans')
    @section('title','View Response Plan List')

    @section('content')
        <a href="{{ route('plans.create') }}" class="btn btn-primary mb-3">Create New Response Plan</a>

        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
                <tr>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Actions</th>
                </tr>
            </thead>
            <tbody>
              @if(count($plans))
                @foreach($plans as $plan)
                    <tr>
                      <td>{{ $plan->name }}</td>
                      <td>{{ $plan->type_text }}</td>
                      <td>
                        <a href="{{ route('plans.edit', $plan) }}" class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger" href="{{ route('types.destroy', $plan) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('delete-{{ $plan->id}}').submit();">
                            {{ __('Delete') }}
                        </a>

                        <form id="delete-{{ $plan->id }}" action="{{ route('plans.destroy', $plan) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                      </td>
                    </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="100%">There are no records yet!</td>
                </tr>
              @endif
            </tbody>

          </table>
        </div>
    @endsection
