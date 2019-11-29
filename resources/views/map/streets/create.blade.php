@extends('layouts.app')
    @section('section','Streets')
    @section('title','Create New Street')

    @section('content')
        <div class="col-6">
          <form action="{{ route('streets.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Street Name...." value="{{ old('name') }}">
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
