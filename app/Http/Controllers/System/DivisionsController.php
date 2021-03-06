<?php namespace App\Http\Controllers\System;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use Illuminate\Support\Facades\Redirect;
    use App\Models\Division;
    use App\Models\Department;
    use App\Models\Type;

    class DivisionsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $divisions = Cache::remember("divisions", 10080, function() {
                return Division::with(['department'])->get();
            });

            return view('system.divisions.index')
              ->withDivisions($divisions);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $departments = Cache::remember("departments", 10080, function() {
                return Department::all();
            });

            $types = Cache::remember("types", 10080, function() {
                return Type::all();
            });

            return view('system.divisions.create')
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
                'department_id' => ['sometimes']
            ]);

            $division = Division::create($attributes);
            $division
              ->types()
              ->attach($request->types);


            Cache::forget("divisions");
            Cache::forget("certifications");
            Cache::forget("roles");

            return Redirect::route("divisions.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Division '{$request->name}' was created successfully!"
              ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Division $division)
        {
            $departments = Cache::remember("departments", 10080, function() {
                return Department::all();
            });

            $types = Cache::remember("types", 10080, function() {
                return Type::all();
            });

            return view('system.divisions.edit')
              ->withDivision($division)
              ->withDepartments($departments)
              ->withTypes($types);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Division $division)
        {
              $attributes = $request->validate([
                  'name'          => ['required'],
                  'abbr'          => ['required'],
                  'department_id' => ['sometimes']
              ]);

              $division->update($attributes);
              $division
                ->types()
                ->sync($request->types);

              Cache::forget("divisions");
              Cache::forget("certifications");
              Cache::forget("roles");

              return Redirect::route("divisions.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Division '{$request->name}' was edited successfully!"
                ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Division $division)
        {
            $division->delete();

            Cache::forget("divisions");
            Cache::forget("certifications");
            Cache::forget("roles");

            return Redirect::route("divisions.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Division '{$division->name}' was deleted successfully!"
              ]);
        }
    }
