@extends('layouts.app')
    @section('section','Response Plans')
    @section('title','Create New Unit Type')

    @section('content')
        <div class="col-6">
          <form action="{{ route('plans.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Unit Type Name...." value="{{ old('name') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Type</label>
                  <select class="form-control" name="type">
                    <option value="1">First & Rescue</option>
                    <option value="2">Law Enforcement</option>
                  </select>
              </div>

              <hr />
              <h5>Responding Units</h5>

              @foreach($types as $type)
                  <div class="form-group">
                      <label for="name">{{ $type->name }}</label>
                      <input type="text" class="form-control" id="{{ $type->id }}" name="{{ $type->id }}" placeholder="Number of Engines...." value="0">
                  </div>
              @endforeach
              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
