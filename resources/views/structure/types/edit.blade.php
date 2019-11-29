@extends('layouts.app')
    @section('section','Unit Types')
    @section('title',"Edit '" . $type->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('types.update', $type) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Unit Type Name...." value="{{ old('name', $type->name) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Unit Type Abbreviation...." value="{{ old('abbr', $type->abbr) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Type</label>
                  <select class="form-control" name="type">
                    <option value="1">First & Rescue</option>
                    <option value="2">Law Enforcement</option>
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
