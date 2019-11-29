<?php namespace App\Http\Controllers\Map;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Street;
    use Illuminate\Support\Facades\Redirect;

    class StreetsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $streets = Cache::remember("streets", 10080, function() {
                return Street::all();
            });

            return view('map.streets.index')
              ->withStreets($streets);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('map.streets.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
              $request->validate([
                'name' => 'required'
              ]);

              Street::create([
                  'name' => $request->name
              ]);

              Cache::forget("streets");

              return Redirect::route("streets.index")
                ->with([
                  'msg.type'      => 'success',
                  'msg.text'      => "Street '{$request->name}' was created successfully!"
                ]);
        }


        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Street $street)
        {
            return view('map.streets.edit')
              ->withStreet($street);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Street $street)
        {
            $request->validate([
                'name'        => ['required']
            ]);

            $street->update(['name' => $request->name]);

            Cache::forget("streets");

            return Redirect::route("streets.index")
              ->with([
                'msg.type'      => 'success',
                'msg.text'      => "Street '{$request->name}' was edited successfully!"
              ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Street $street)
        {
            $street->delete();

            Cache::forget("streets");

            return Redirect::route("streets.index")
              ->with([
                'msg.type'      => 'success',
                'msg.text'      => "Street '{$street->name}' was deleted successfully!"
              ]);
        }
    }
