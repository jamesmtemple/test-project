@extends('layouts.app')
    @section('section','Apparatus')
    @section('title',"Edit '" . $unit->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('apparatus.update', $unit) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Apparatus Name...." value="{{ old('name', $unit->name) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Apparatus Abbreviation...." value="{{ old('abbr', $unit->abbr) }}">
              </div>

              <div class="form-group">
                  <label for="color">Department</label>

                  <select name="department_id" class="form-control">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" @if($department->id === $unit->department_id) selected @endif>{{ $department->name }}</option>
                    @endforeach
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
