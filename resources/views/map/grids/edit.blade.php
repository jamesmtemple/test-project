@extends('layouts.app')
    @section('section','Grids')
    @section('title',"Edit '" . $grid->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('grids.update', $grid) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Grid ID</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Grid ID...." value="{{ old('name', $grid->name) }}">
              </div>

              <div class="form-group">
              <label for="abbr">Nearest Dock</label>
                  <select class="form-control" name="nearest_dock_id">
                      @foreach($postals as $postal)
                        <option value="{{ $postal->id }}" @if($grid->nearest_dock_id == $postal->id) selected @endif>{{ $postal->name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
              <label for="abbr">Nearest Helipad</label>
                  <select class="form-control" name="nearest_helipad_id">
                      @foreach($postals as $postal)
                        <option value="{{ $postal->id }}" @if($grid->nearest_dock_id == $postal->id) selected @endif>{{ $postal->name }}</option>
                      @endforeach
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
