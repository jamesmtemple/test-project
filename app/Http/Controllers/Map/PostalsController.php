<?php namespace App\Http\Controllers\Map;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Postal;
    use App\Models\Street;
    use App\Models\Station;
    use Illuminate\Support\Facades\Redirect;

    class PostalsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $postals = Cache::remember("postals", 10080, function() {
                return Postal::all();
            });;

            return view('map.postals.index')
              ->withPostals($postals);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $stations = Cache::remember("stations", 10080, function() {
                return Station::all();
            });

            $streets = Cache::remember("streets", 10080, function() {
                return Street::all();
            });

            return view('map.postals.create')
              ->withStations($stations)
              ->withStreets($streets);
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
                'common_name'           => ['required'],
                'name'                  => ['required','unique:postals'],
                'description'           => ['sometimes'],
                'cross_street_one_id'   => ['required'],
                'cross_street_two_id'   => ['required'],
                'hazmat_alert'          => ['sometimes'],
                'brush_alert'           => ['sometimes'],
                'leo_alert'             => ['sometimes'],
                'fire_station_id'       => ['required']
            ]);

            Postal::create($attributes);

            Cache::forget("postals");

            return Redirect::route("postals.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Postal '{$request->name}' was created successfully!"
              ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Postal $postal)
        {
            $stations = Cache::remember("stations", 10080, function() {
                return Station::all();
            });

            $streets = Cache::remember("streets", 10080, function() {
                return Street::all();
            });

            return view('map.postals.edit')
              ->withStations($stations)
              ->withStreets($streets)
              ->withPostal($postal);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Postal $postal)
        {
            $attributes = $request->validate([
                'common_name'           => ['required'],
                'name'                  => ['required','unique:postals,name,' . $postal->id],
                'description'           => ['sometimes'],
                'cross_street_one_id'   => ['required'],
                'cross_street_two_id'   => ['required'],
                'hazmat_alert'          => ['sometimes'],
                'brush_alert'           => ['sometimes'],
                'leo_alert'             => ['sometimes'],
                'fire_station_id'       => ['required']
            ]);

            $postal->update($attributes);

            Cache::forget("postals");

            return Redirect::route("postals.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Postal '{$request->name}' was edited successfully!"
              ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Postal $postal)
        {
            $postal->delete();

            Cache::forget("postals");

            return Redirect::route("postals.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Postal '{$postal->name}' was edited successfully!"
              ]);
        }
    }
