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
                      <select class="form-control" id="department_id" name="type" v-model="type">
                          <option value="1">Global</option>
                          <option value="2">Department</option>
                          <option value="3">Division</option>
                      </select>
                  </div>

                  <div v-if="type == 2" class="form-group">
                      <label for="abbr">Department</label>
                      <select class="form-control" id="department_id" name="department_id">
                        <option value="0">Select a Department....</option>
                        @foreach($departments as $department)
                          <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                      </select>
                  </div>

                  <div v-if="type == 3" class="form-group">
                      <label for="abbr">Division</label>
                      <select class="form-control" id="division_id" name="division_id">
                        <option value="0">Select a Division....</option>
                        @foreach($divisions as $division)
                          <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                      </select>
                  </div>
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


            <h4>Permissions</h4>

            <div class="row">
              @foreach($permissions as $group => $chunk)
                <div class="col-4 display-block">
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

    @section('scripts')
        <script type="text/javascript">
            new Vue({
                el: "#app",

                data: {
                  type: "1"
                }
            });
        </script
    @endsection
