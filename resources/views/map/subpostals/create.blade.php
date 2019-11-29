@extends('layouts.app')
    @section('section','Subpostals')
    @section('title','Create New Subpostal')

    @section('content')
        <div class="col-6">
          <form action="{{ route('subpostals.store') }}" method="POST">
              @csrf

          <div class="form-group">
          <label for="abbr">Postal ID</label>
              <select class="form-control" name="postal_id">
                  @foreach($postals as $postal)
                    <option value="{{ $postal->id }}">{{ $postal->name }}</option>
                  @endforeach
              </select>
          </div>

          <div class="form-group">
              <label for="name">Subpostal ID</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Subpostal ID...." value="{{ old('name') }}">
          </div>

          <div class="form-group">
              <label for="name">Description</label>
              <textarea class="form-control" id="description" name="description" placeholder="Description of Subpostal(Optional)....">{{ old('description') }}</textarea>
          </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
