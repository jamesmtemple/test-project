<?php namespace App\Http\Controllers\Map;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\TrailMarker;
    use App\Models\Postal;
    use Illuminate\Support\Facades\Redirect;

    class TrailMarkersController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $trailmarkers = Cache::remember("trailmarkers", 10080, function() {
                return TrailMarker::with(['nearest_postal'])->get();
            });

            return view('map.trailmarkers.index')
              ->withTrailmarkers($trailmarkers);
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $postals = Cache::remember("postals", 10080, function() {
                return Postal::all();
            });

            return view('map.trailmarkers.create')
              ->withPostals($postals);
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
                    'name'              => ['required','unique:trail_markers'],
                    'location'          => ['required'],
                    'description'       => ['sometimes'],
                    'road_accessible'   => ['required'],
                    'nearest_postal_id' => ['required']
              ]);

              TrailMarker::create($attributes);

              Cache::forget("trailmarkers");;

              return Redirect::route("trailmarkers.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Trailmarker '{$request->name}' was created successfully!"
                ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Trailmarker $trailmarker)
        {
            $postals = Cache::remember("postals", 10080, function() {
                return Postal::all();
            });

            return view('map.trailmarkers.edit')
              ->withPostals($postals)
              ->withTrailmarker($trailmarker);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Trailmarker $trailmarker)
        {
              $attributes = $request->validate([
                    'name'              => ['required','unique:trail_markers,name,' . $trailmarker->id],
                    'location'          => ['required'],
                    'description'       => ['sometimes'],
                    'road_accessible'   => ['required'],
                    'nearest_postal_id' => ['required']
              ]);

              $trailmarker->update($attributes);

              Cache::forget("trailmarkers");

              return Redirect::route("trailmarkers.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Trailmarker '{$request->name}' was created successfully!"
                ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Trailmarker $trailmarker)
        {
            $trailmarker->delete();

            Cache::forget("trailmarkers");

            return Redirect::route("trailmarkers.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Trailmarker '{$trailmarker->name}' was created successfully!"
              ]);
        }
    }
