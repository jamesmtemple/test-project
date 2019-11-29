<?php namespace App\Http\Controllers\System;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Certification;
    use App\Models\Permission;
    use App\Models\Department;
    use App\Models\Division;
    use App\Models\Type;
    use Illuminate\Support\Facades\Redirect;

    class CertificationsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $certifications = Cache::remember("certifications", 10080, function() {
                return Certification::with(['department','division'])->get();
            });

            return view('system.certifications.index')
              ->withCertifications($certifications);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create(Request $request)
        {
            if($request->get('dept')) {
              $deptPermissions = Department::find($request->get('dept'))->permissions;
            }

            $permissions = ($request->get('dept')) ? $deptPermissions : Cache::remember("permissions", 10080, function(){
                return Permission::all();
            });

            $departments = Cache::remember("departments", 10080, function(){
                return Department::all();
            });

            $divisions = Cache::remember("divisions", 10080, function(){
                return Division::all();
            });

            $types = Cache::remember("types", 10080,  function() {
                return Type::all();
            });

            return view('system.certifications.create')
              ->withPermissions($permissions->groupBy('category'))
              ->withDivisions($divisions)
              ->withDepartments($departments)
              ->withTypes($types);
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
                'name'          => ['required'],
                'abbr'          => ['required'],
                'type'          => ['required'],
                'department_id' => ['sometimes'],
                'division_id'   => ['sometimes']
            ]);

            $cert = Certification::create($attributes);
            $cert
              ->permissions()
              ->attach($request->permissions);
            $cert
              ->types()
              ->attach($request->types);

            Cache::forget("certifications");

            return Redirect::route("certifications.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Certification '{$request->name}' was created successfully!"
              ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Certification $certification)
        {
            $departments = Cache::remember("departments", 10080, function(){
                return Department::all();
            });

            $divisions = Cache::remember("divisions", 10080, function(){
                return Division::all();
            });

            $types = Cache::remember("types", 10080,  function() {
                return Type::all();
            });

            return view('system.certifications.edit')
              ->withCertification($certification)
              ->withDivisions($divisions)
              ->withDepartments($departments)
              ->withTypes($types)
              ->withPermissions($certification->department->permissions->groupBy('category'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Certification $certification)
        {
            $attributes = $request->validate([
                'name'          => ['required'],
                'abbr'          => ['required'],
                'type'          => ['required'],
                'department_id' => ['sometimes'],
                'division_id'   => ['sometimes']
            ]);

            $certification->update($attributes);
            $certification
              ->permissions()
              ->sync($request->permissions);
            $certification
              ->types()
              ->sync($request->types);

            Cache::forget("certifications");

            return Redirect::route("certifications.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Certification '{$request->name}' was edited successfully!"
              ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Certification $certification)
        {
            $certification->delete();

            Cache::forget("certifications");

            return Redirect::route("certifications.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Certification '{$certification->name}' was edited successfully!"
              ]);
        }
    }
