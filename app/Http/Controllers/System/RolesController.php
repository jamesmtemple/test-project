<?php namespace App\Http\Controllers\System;
  use App\Http\Controllers\Controller;
  use Illuminate\Http\Request;
  use App\Models\Role;
  use App\Models\Permission;
  use App\Models\Department;
  use Illuminate\Support\Facades\Cache;
  use Illuminate\Support\Facades\Redirect;

  class RolesController extends Controller
  {
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index(Request $request)
      {
          $roles = Cache::remember("roles", 10080, function() {
              return Role::with(['division','department','division.department'])->get();
          });

          return view('system.roles.index')
            ->withRoles($roles);
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
          $permissions = Cache::remember("permissions", 10080, function(){
              return Permission::all();
          });

          $departments = Cache::remember("departments", 10080, function(){
              return Department::all();
          });

          $divisions = Cache::remember("divisions", 10080, function(){
              return Division::all();
          });

          return view('system.roles.create')
            ->withPermissions($permissions->groupBy('category'))
            ->withDivisions($divisions)
            ->withDepartments($departments);
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function store(Request $request)
      {
          $attributes = $request->validate([
              'name'          => ['required','unique:roles'],
              'type'          => ['required','integer'],
              'department_id' => ['sometimes'],
              'division_id'   => ['sometimes']
          ]);

          Role::create($attributes)
            ->permissions()
            ->attach($request->roles);

          Cache::forget("roles");

          return Redirect::route("roles.index")
            ->with([
              'msg.type'      => 'success',
              'msg.text'      => "Role '{$request->name}' was created successfully!"
            ]);
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function edit(Role $role)
      {
          $permissions = Cache::remember("permissions", 10080, function(){
              return Permission::all();
          });

          $departments = Cache::remember("departments", 10080, function(){
              return Department::all();
          });

          $divisions = Cache::remember("divisions", 10080, function(){
              return Division::all();
          });

          return view('system.roles.edit')
            ->withRole($role)
            ->withPermissions($permissions->groupBy('category'))
            ->withDivisions($divisions)
            ->withDepartments($departments);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \Illuminate\Http\Request  $request
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, Role $role)
      {
          $attributes = $request->validate([
              'name'          => ['required','unique:roles,name,' . $role->id],
              'type'          => ['required','integer'],
              'department_id' => ['sometimes'],
              'division_id'   => ['sometimes']
          ]);

          $role->update($attributes);
          $role->permissions()->sync($request->permissions);

          Cache::forget("roles");

          return Redirect::route("roles.index")
            ->with([
              'msg.type'      => 'success',
              'msg.text'      => "Role '{$request->name}' was edited successfully!"
            ]);
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy(Role $role)
      {
          $role->delete();

          Cache::forget("roles");

          return Redirect::route("roles.index")
            ->with([
              'msg.type'      => 'success',
              'msg.text'      => "Role '{$role->name}' was edited successfully!"
            ]);
      }
  }
