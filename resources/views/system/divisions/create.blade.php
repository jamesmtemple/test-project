@extends('layouts.app')
    @section('section','Divisions')
    @section('title','Create New Division')

    @section('content')
        <div class="col-6">
          <form action="{{ route('divisions.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Division Name...." value="{{ old('name') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Division Abbreviation...." value="{{ old('abbr') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Department</label>
                  <select class="form-control" id="department_id" name="department_id">
                      <option value="0">All-Department Sub Division</option>
                      @foreach($departments as $department)
                        <option value="{{ $department->id }}" @if($department->id === old('department_id')) selected @endif>{{ $department->name }}</option>
                      @endforeach
                  </select>
              </div>

              <div class="form-group">
                <h4>Fire Units</h4>
                  @foreach($types->where('type',1) as $type)
                      <div>
                        <div class="display-block">
                          <label><input type="checkbox" name="types[]" value="{{ $type->id }}" /> {{ $type->name }}</label>
                        </div>
                      </div>
                  @endforeach
              </div>

              <div class="form-group">
                <h4>Law Enforcement</h4>
                  @foreach($types->where('type',2) as $type)
                      <div>
                        <div class="display-block">
                          <label><input type="checkbox" name="types[]" value="{{ $type->id }}" /> {{ $type->name }}</label>
                        </div>
                      </div>
                  @endforeach
              </div>

              <button class="btn btn-primary">Save</button>
          </form>
        </div>
    @endsection
