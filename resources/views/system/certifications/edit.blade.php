@extends('layouts.app')
    @section('section','Certifications')
    @section('title',"Edit '" . $certification->name . "'")

    @section('content')
        <div class="col-6">
          <form action="{{ route('certifications.update', $certification) }}" method="POST">
              @csrf
              @method('patch')

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Certification Name...." value="{{ old('name', $certification->name) }}">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Certification Abbreviation...." value="{{ old('abbr', $certification->abbr) }}">
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
                      <option value="{{ $department->id }}" @if($certification->department_id == $department->id) selected @endif>{{ $department->name }}</option>
                    @endforeach
                  </select>
              </div>

              <div v-if="type == 2" class="form-group">
                  <label >Division</label>
                  <select class="form-control" name="division_id">
                    <option value="0">Select a Division...</option>
                    @foreach($divisions as $division)
                      <option value="{{ $division->id }}" @if($certification->division_id == $division->id) selected @endif>{{ $division->name }}</option>
                    @endforeach
                  </select>
              </div>

              <h4>Permissions</h4>

              <div class="row">
                @foreach($permissions as $group => $chunk)
                  <div class="display-block">
                    <span>{{ ucwords(str_replace("-", " ", $group)) }}</span>


                    @foreach($chunk as $permission)
                      <div>
                      <label for="{{ $permission->name }}">
                        <div class="display-block">
                          <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @if($certification->hasPermission($permission->name)) checked @endif/> {{ $permission->description }}</label>
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
                  type: "{{ $certification->type }}"
                }
            })
        </script>
    @endsection
