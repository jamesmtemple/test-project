<?php namespace App\Http\Controllers\Structure;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Station;
    use App\Models\Type;
    use Illuminate\Support\Facades\Redirect;

    class StationsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $stations = Cache::remember("stations", 10080, function() {
                return Station::all();
            });

            return view('structure.stations.index')
              ->withStations($stations);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $types = Cache::remember("types", 10080, function() {
                return Type::all();
            });

            return view('structure.stations.create')
              ->withTypes($types->where('type','1'));
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
                'name'          => ['required','unique:stations'],
                'location'      => ['required']
            ]);

            $responseArray = $request->except(['_method', '_token', 'name', 'location']);

            Station::create([
                'location'      => $request->location,
                'name'          => $request->name,
                'units'         => $responseArray
            ]);

            Cache::forget("stations");

            return Redirect::route("stations.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Station '{$request->name}' was created successfully!"
              ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Station $station)
        {
            $types = Cache::remember("types", 10080, function() {
                return Type::all();
            });

            return view('structure.stations.edit')
              ->withTypes($types->where('type','1'))
              ->withStation($station);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Station $station)
        {
              $request->validate([
                  'name'          => ['required','unique:stations,name,' . $station->id],
                  'location'      => ['required']
              ]);

              $responseArray = $request->except(['_method', '_token', 'name', 'location']);

              $station->update([
                  'location'      => $request->location,
                  'name'          => $request->name,
                  'units'         => $responseArray
              ]);

              Cache::forget("stations");

              return Redirect::route("stations.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Station '{$request->name}' was edited successfully!"
                ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Station $station)
        {
              $station->delete();

              Cache::forget("stations");

              return Redirect::route("stations.index")
                  ->with([
                      'msg.type'          => 'success',
                      'msg.text'          => "Station '{$station->name}' was edited successfully!"
                  ]);
        }
    }
