@extends('layouts.app')
    @section('section','Trailmarkers')
    @section('title',"Edit '" . $trailmarker->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('trailmarkers.update', $trailmarker) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Trailmarker ID</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Trailmarker ID...." value="{{ old('name', $trailmarker->name) }}">
              </div>

              <div class="form-group">
                  <label for="name">Location</label>
                  <input type="text" class="form-control" id="location" name="location" placeholder="Location...." value="{{ old('location', $trailmarker->location) }}">
              </div>

              <div class="form-group">
                  <label for="name">Description</label>
                  <textarea class="form-control" id="description" name="description" placeholder="Description of Subpostal(Optional)....">{{ old('description', $trailmarker->description) }}</textarea>
              </div>

              <hr />


              <div class="form-group">
              <label for="abbr">Road Accessible</label>
                  <select class="form-control" name="road_accessible">
                    <option value="1" @if($trailmarker->road_accessible) selected @endif>Yes</option>
                    <optoin value="0" @if(! $trailmarker->road_accessible) selected @endif>No</option>
                  </select>
              </div>

              <div class="form-group">
              <label for="abbr">Nearest Postal</label>
                  <select class="form-control" name="nearest_postal_id">
                      @foreach($postals as $postal)
                        <option value="{{ $postal->id }}" @if($trailmarker->nearest_postal_id == $postal->id) selected @endif>{{ $postal->name }}</option>
                      @endforeach
                  </select>
              </div>



              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
