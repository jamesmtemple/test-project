@extends('layouts.app')
    @section('section','Postals')
    @section('title',"Edit '" . $postal->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('postals.update', $postal) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="abbr">Common Name</label>
                  <input type="text" class="form-control" id="abbr" name="common_name" placeholder="Common Name...." value="{{ old('common_name', $postal->common_name) }}">
              </div>

              <div class="form-group">
                  <label for="name">Postal ID</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Postal ID...." value="{{ old('name', $postal->name) }}">
              </div>

              <div class="form-group">
                  <label for="name">Description</label>
                  <textarea class="form-control" id="description" name="description" placeholder="Description of Postal(Optional)....">{{ old('description', $postal->description) }}</textarea>
              </div>

              <hr />

              <div class="form-group">
                  <label for="abbr">Cross Street One</label>
                  <select class="form-control" name="cross_street_one_id">
                      <option value="0">No Cross Street</option>
                      @foreach($streets as $street)
                        <option value="{{ $street->id }}" @if($street->id === $postal->cross_street_one_id) selected @endif>{{ $street->name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label for="abbr">Cross Street Two</label>
                  <select class="form-control" name="cross_street_two_id">
                      <option value="0">No Cross Street</option>
                      @foreach($streets as $street)
                        <option value="{{ $street->id }}" @if($street->id === $postal->cross_street_one_id) selected @endif>{{ $street->name }}</option>
                      @endforeach
                  </select>
              </div>

              <hr />

              <div>
                <div class="display-block">
                    <label for="hazmat_alert"><input type="checkbox" value="1" name="hazmat_alert" @if($postal->hazmat_alert) checked @endif /> HAZMAT Alert</label>
                </div>
              </div>

              <div>
                <div class="display-block">
                    <label for="brush_alert"><input type="checkbox" value="1" name="brush_alert" @if($postal->brush_alert) checked @endif /> Brush Alert</label>
                </div>
              </div>

              <div>
                <div class="display-block">
                    <label for="pd_alert"><input type="checkbox" value="1" name="leo_alert" @if($postal->leo_alert) checked @endif /> LEO Alert</label>
                </div>
              </div>

              <hr />

              <div class="form-group">
                  <label for="abbr">Preferred Fire Station</label>
                  <select class="form-control" id="fire_station_id" name="fire_station_id">
                      <option value="0">Select a Department...</option>
                      @foreach($stations as $station)
                        <option value="{{ $station->id }}" @if($station->id == old('fire_station_id', $postal->fire_station_id)) selected @endif>{{ $station->name }}</option>
                      @endforeach
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
