@extends('layouts.app')
    @section('section','Stations')
    @section('title','Create New Fire Station')

    @section('content')
        <div class="col-6">
          <form action="{{ route('stations.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Fire Station Name...." value="{{ old('name') }}">
              </div>

              <div class="form-group">
                  <label for="name">Patrol Location</label>
                  <input type="text" class="form-control" id="location" name="location" placeholder="Fire Station Name...." value="{{ old('location') }}">
              </div>

              <hr />
              <h4>Units Available</h4>

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

    @section('scripts')
        <script type="text/javascript">
            new Vue({
                el: "#app",
            })
        </script>
    @endsection
