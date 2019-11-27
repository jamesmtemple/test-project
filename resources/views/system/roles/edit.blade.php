@extends('layouts.app')
    @section('section','Roles')
    @section('title',"Edit '" . $role->name . "'")

    @section('content')
          <form action="{{ route('roles.update', $role) }}" method="POST">
              @csrf
              @method('patch')

              <div class="col-6">
                  <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Role Name...." value="{{ old('name', $role->name) }}">
                  </div>

                  <div class="form-group">
                      <label for="abbr">Type</label>
                      <select class="form-control" id="type" name="type">
                          <option value="1" @if($role->type == 1) selected @endif>Global</option>
                          <option value="2" @if($role->type == 2) selected @endif>Department</option>
                          <option value="3" @if($role->type == 3) selected @endif>Division</option>
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
                    <label>
                      <div class="display-block">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->hasPermission($permission->name)) checked @endif/> {{ $permission->description }}</label>
                      </div>
                    </div>
                  @endforeach
                </div>
              @endforeach
            </div>

              <button class="btn btn-primary">Save</button>
          </form>
    @endsection
