<?php namespace App\Http\Controllers\System;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Department;
    use Illuminate\Support\Facades\Redirect;

    class DepartmentsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $departments = Cache::remember("departments", 10080, function() {
                return Department::all();
            });

            return view('system.departments.index')
              ->withDepartments($departments);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('system.departments.create');
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
                'name'          => ['required','unique:departments'],
                'abbr'          => ['required','unique:departments'],
                'type'          => ['required']
            ]);

            Department::create($attributes);

            Cache::forget("departments");

            return Redirect::route("departments.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Department '{$request->name}' was created successfully!"
              ]);
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Department $department)
        {
            return view('system.departments.edit')
              ->withDepartment($department);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Department $department)
        {
              $attributes = $request->validate([
                  'name'          => ['required','unique:departments,name,' . $department->id],
                  'abbr'          => ['required','unique:departments,abbr,' . $department->id],
                  'type'          => ['required']
              ]);

              $department->update($attributes);

              Cache::forget("departments");

              return Redirect::route("departments.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Department '{$department->name}' was edited successfully!"
                ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Department $department)
        {
            $department->delete();

            Cache::forget("departments");

            return Redirect::route("departments.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Department '{$department->name}' was deleted successfully!"
              ]);
        }
    }
