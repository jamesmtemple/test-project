<?php namespace App\Http\Controllers\System;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Type;
    use App\Models\Department;
    use App\Models\Division;
    use App\Http\Controllers\Controller;

    class TypesController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $types = Cache::remember("types", 10080, function() {
                return Type::all();
            });

            return view('structure.types.index')
              ->withTypes($types);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $departments = Cache::remember("departments", 10080, function(){
                return Department::all();
            });

            $divisions = Cache::remember("divisions", 10080, function(){
                return Division::all();
            });

            return view('structure.types.create')
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
                'name'          => ['required'],
                'abbr'          => ['required'],
                'type'          => ['required'],
                'department_id' => ['sometimes'],
                'division_id'   => ['sometimes']
            ]);

            Type::create($attributes);

            Cache::forget("types");

            return Redirect::route("types.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Type '{$request->name}' was created successfully!"
              ]);
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            //
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            //
        }
    }
