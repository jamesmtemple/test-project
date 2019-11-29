@extends('layouts.app')
    @section('section','Certifications')
    @section('title','Create New Certification')

    @section('content')
        <div class="col-6">
          <form action="{{ route('certifications.store') }}" method="POST">
              @csrf

              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Certification Name...." v-model="name">
              </div>

              <div class="form-group">
                  <label for="abbr">Abbreviation</label>
                  <input type="text" class="form-control" id="abbr" name="abbr" placeholder="Certification Abbreviation...." v-model="abbr">
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
                  <select class="form-control" name="department_id" v-model="department" @change="onChange">
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
        </div>
    @endsection

    @section('scripts')
        <script type="text/javascript">
            new Vue({
                el: "#app",

                data: {
                  name: "{{ request()->get('name') }}",
                  abbr: "{{ request()->get('abbr') }}",
                  type: "{{ request()->get('type', '1') }}",
                  department: "{{ request()->get('dept') }}"
                },

                methods: {
                  onChange: function(event) {
                      let q = "name=" + this.name + "&abbr=" + this.abbr + "&type=" + this.type + "&dept=" + event.target.value;
                      window.location.replace("/certifications/create?" + q);
                  }
                }
            })
        </script>
    @endsection
