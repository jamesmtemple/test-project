@extends('layouts.app')
    @section('section','Departments')
    @section('title','Create New Department')

    @section('content')
        <div class="col-6">
          <form action="{{ route('departments.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Department Name...." value="{{ old('name') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Department Abbreviation...." value="{{ old('abbr') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Type</label>
                  <select class="form-control" id="type" name="type">
                    <option value="1">Civilian</option>
                    <option value="2">Communications</options>
                    <option value="3">Fire & Rescue</option>
                    <option value="4">Law Enforcement</option>
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
