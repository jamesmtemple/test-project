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
                  <select class="form-control" name="type" v-model="type">
                    <option value="1">Department</option>
                    <option value="2">Sub Division</option>
                  </select>
              </div>

              <div v-if="type == 1" class="form-group">
                  <label >Department</label>
                  <select class="form-control" name="department_id">
                    <option value="0">Select a Department...</option>
                    @foreach($departments as $department)
                      <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                  </select>
              </div>

              <div v-if="type == 2" class="form-group">
                  <label >Division</label>
                  <select class="form-control" name="division_id">
                    <option value="0">Select a Division...</option>
                    @foreach($divisions as $division)
                      <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                  </select>
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            new Vue({
                el: "#app",

                data: {
                  type: "1"
                }
            })
        </script>
    @endsection
