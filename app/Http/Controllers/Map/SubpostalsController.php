<?php namespace App\Http\Controllers\Map;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Subpostal;
    use App\Models\Postal;
    use Illuminate\Support\Facades\Redirect;

    class SubpostalsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $subpostals = Cache::remember("subpostals", 10080, function() {
                return Subpostal::with(['postal'])->get();
            });

            return view('map.subpostals.index')
              ->withSubpostals($subpostals);
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

            return view('map.subpostals.create')
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
                  'name'          => ['required'],
                  'postal_id'     => ['required'],
                  'description'   => ['sometimes']
              ]);

              Subpostal::create($attributes);

              Cache::forget("subpostals");

              return Redirect::route("subpostals.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Subpostal '{$request->name}' was created successfully!"
                ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Subpostal $subpostal)
        {
            $postals = Cache::remember("postals", 10080, function() {
                return Postal::all();
            });

            return view('map.subpostals.edit')
              ->withPostals($postals)
              ->withSubpostal($subpostal);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Subpostal $subpostal)
        {
              $attributes = $request->validate([
                  'name'          => ['required'],
                  'postal_id'     => ['required'],
                  'description'   => ['sometimes']
              ]);

              $subpostal->update($attributes);

              Cache::forget("subpostals");

              return Redirect::route("subpostals.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Subpostal '{$request->name}' was edited successfully!"
                ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Subpostal $subpostal)
        {
            $subpostal->delete();

            Cache::forget("subpostals");

            return Redirect::route("subpostals.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Subpostal '{$subpostal->name}' was deleted successfully!"
              ]);
        }
    }
