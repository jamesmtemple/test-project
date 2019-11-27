@extends('layouts.app')
    @section('section','Roles')
    @section('title','Create New Role')

    @section('content')
          <form action="{{ route('roles.store') }}" method="POST">
              @csrf

              <div class="col-6">
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Role Name...." value="{{ old('name') }}">
                  </div>


                  <div class="form-group">
                      <label for="abbr">Type</label>
                      <select class="form-control" id="department_id" name="type">
                          <option value="1">Global</option>
                          <option value="2">Department</option>
                          <option value="3">Division</option>
                      </select>
                  </div>
              </div>

            <h4>Permissions</h4>

            <div class="row">
              @foreach($permissions as $group => $chunk)
                <div class="display-block">
                  <span>{{ ucwords(str_replace("-", " ", $group)) }}</span>


                  @foreach($chunk as $permission)
                    <div>
                      <div class="display-block">
                        <label><input type="checkbox" name="permissions[]" value="{{ $permission->id }}" /> {{ $permission->description }}</label>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>
              <button class="btn btn-primary">Save</button>
          </form>
    @endsection
