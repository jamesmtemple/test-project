<?php namespace App\Http\Controllers\Map;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Grid;
    use App\Models\Postal;
    use Illuminate\Support\Facades\Redirect;

    class GridsController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $grids = Cache::remember("grids", 10080, function() {
                return Grid::all();
            });

            return view('map.grids.index')
              ->withGrids($grids);
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

            return view('map.grids.create')
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
                'name'               => ['required'],
                'nearest_dock_id'    => ['required'],
                'nearest_helipad_id' => ['required']
            ]);

            Grid::create($attributes);

            Cache::forget("grids");;

            return Redirect::route("grids.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Grid '{$request->name}' was created successfully!"
              ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Grid $grid)
        {
            $postals = Cache::remember("postals", 10080, function() {
                return Postal::all();
            });

            return view('map.grids.edit')
              ->withGrid($grid)
              ->withPostals($postals);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Grid $grid)
        {
            $attributes = $request->validate([
                'name'               => ['required'],
                'nearest_dock_id'    => ['required'],
                'nearest_helipad_id' => ['required']
            ]);

            $grid->update($attributes);

            Cache::forget("grids");;

            return Redirect::route("grids.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Grid '{$request->name}' was edited successfully!"
              ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Grid $grid)
        {
            $grid->delete();

            Cache::forget("grids");;

            return Redirect::route("grids.index")
              ->with([
                'msg.type'          => 'success',
                'msg.text'          => "Grid '{$grid->name}' was deleted successfully!"
              ]);
        }
    }
