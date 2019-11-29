@extends('layouts.app')
    @section('section','Trailmarkers')
    @section('title','Create New Trailmarker')

    @section('content')
        <div class="col-6">
          <form action="{{ route('trailmarkers.store') }}" method="POST">
              @csrf

          <div class="form-group">
              <label for="name">Trailmarker ID</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Trailmarker ID...." value="{{ old('name') }}">
          </div>

          <div class="form-group">
              <label for="name">Location</label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Location...." value="{{ old('location') }}">
          </div>

          <div class="form-group">
              <label for="name">Description</label>
              <textarea class="form-control" id="description" name="description" placeholder="Description of Subpostal(Optional)....">{{ old('description') }}</textarea>
          </div>

          <hr />


          <div class="form-group">
          <label for="abbr">Road Accessible</label>
              <select class="form-control" name="road_accessible">
                <option value="1">Yes</option>
                <optoin value="2">No</option>
              </select>
          </div>

          <div class="form-group">
          <label for="abbr">Nearest Postal</label>
              <select class="form-control" name="nearest_postal_id">
                  @foreach($postals as $postal)
                    <option value="{{ $postal->id }}">{{ $postal->name }}</option>
                  @endforeach
              </select>
          </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
