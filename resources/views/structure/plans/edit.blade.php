@extends('layouts.app')
    @section('section','Response Plans')
    @section('title',"Edit '" . $plan->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('plans.update', $plan) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Unit Type Name...." value="{{ old('name', $plan->name) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Type</label>
                  <select class="form-control" name="type">
                    <option value="1" @if($plan->type == 1) selected @endif>First & Rescue</option>
                    <option value="2" @if($plan->type == 2) selected @endif>Law Enforcement</option>
                  </select>
              </div>

              <h5>Responding Units</h5>

              @foreach($types as $type)
                  <div class="form-group">
                      <label for="name">{{ $type->name }}</label>
                      <input type="text" class="form-control" id="{{ $type->id }}" name="{{ $type->id }}" placeholder="Number of Engines...." value="{{ $plan->response[$type->id] }}">
                  </div>
              @endforeach

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
