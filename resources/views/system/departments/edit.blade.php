@extends('layouts.app')
    @section('section','Departments')
    @section('title',"Edit '" . $department->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('departments.update', $department) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Department Name...." value="{{ old('name', $department->name) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Department Abbreviation...." value="{{ old('abbr', $department->abbr) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Type</label>
                  <select class="form-control" id="type" name="type">
                    <option value="1" @if($department->type == 1) selected @endif>Civilian</option>
                    <option value="2" @if($department->type == 2) selected @endif>Communications</options>
                    <option value="3" @if($department->type == 3) selected @endif>Fire & Rescue</option>
                    <option value="4" @if($department->type == 4) selected @endif>Law Enforcement</option>
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
