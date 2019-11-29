@extends('layouts.app')
    @section('section','Unit Types')
    @section('title','Create New Unit Type')

    @section('content')
        <div class="col-6">
          <form action="{{ route('types.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Unit Type Name...." value="{{ old('name') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Unit Type Abbreviation...." value="{{ old('abbr') }}">
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
