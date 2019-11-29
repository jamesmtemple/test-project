@extends('layouts.app')
    @section('section','Departments')
    @section('title','Create New Department')

    @section('content')
        <div class="col-6">
          <form action="{{ route('departments.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Department Name...." value="{{ old('name') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Department Abbreviation...." value="{{ old('abbr') }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Type</label>
                  <select class="form-control" id="type" name="type" v-model="type">
                    <option value="1">Civilian</option>
                    <option value="2">Communications</options>
                    <option value="3">Fire & Rescue</option>
                    <option value="4">Law Enforcement</option>
                  </select>
              </div>

              <div v-if="type == 3" class="form-group">
                <h4>Fire Units</h4>
                  @foreach($types->where('type',1) as $type)
                      <div>
                        <div class="display-block">
                          <label><input type="checkbox" name="types[]" value="{{ $type->id }}" /> {{ $type->name }}</label>
                        </div>
                      </div>
                  @endforeach
              </div>

              <div v-if="type == 4" class="form-group">
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
        </div>
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
