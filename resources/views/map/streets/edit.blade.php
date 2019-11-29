@extends('layouts.app')
    @section('section','Streets')
    @section('title',"Edit '" . $street->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('streets.update', $street) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Street Name...." value="{{ old('name', $street->name) }}">
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
