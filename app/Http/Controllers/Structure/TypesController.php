<?php namespace App\Http\Controllers\Structure;
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
            return view('structure.types.create');
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
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Type $type)
        {
            return view('structure.types.edit')
              ->withType($type);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Type $type)
        {
            $attributes = $request->validate([
                'name'          => ['required'],
                'abbr'          => ['required'],
                'type'          => ['required'],
            ]);

            $type->update($attributes);

            Cache::forget("types");

            return Redirect::route("types.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Type '{$request->name}' was edited successfully!"
              ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Type $type)
        {
            $type->delete();

            Cache::forget("types");

            return Redirect::route("types.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Type '{$type->name}' was deleted successfully!"
              ]);
        }
    }
