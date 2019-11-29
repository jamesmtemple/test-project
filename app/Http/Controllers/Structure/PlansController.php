<?php namespace App\Http\Controllers\Structure;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Cache;
    use App\Models\Plan;
    use App\Models\Type;
    use Illuminate\Support\Facades\Redirect;

    class PlansController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $plans = Cache::remember("plans", 10080, function() {
                return Plan::all();
            });

            return view('structure.plans.index')
              ->withPlans(Plan::all());
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

            return view('structure.plans.create')
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
              $request->validate([
                  'name'          => ['required', 'unique:plans'],
                  'type'          => ['required','integer']
              ]);

              $responseArray = $request->except(['_method', '_token', 'name', 'type']);

              Plan::create([
                'name'          => $request->name,
                'type'          => $request->type,
                'response'      => $responseArray
              ]);

              Cache::forget("plans");

              return Redirect::route("plans.index")
                ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Plan '{$request->name}' was created successfully!"
                ]);
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit(Plan $plan)
        {
            $types = Cache::remember("types", 10080, function() {
                return Type::all();
            });

            return view('structure.plans.edit')
              ->withTypes($types)
              ->withPlan($plan);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Plan $plan)
        {
            $request->validate([
                'name'          => ['required', 'unique:plans,name,' . $plan->id],
                'type'          => ['required','integer']
            ]);

            $responseArray = $request->except(['_method', '_token', 'name', 'type']);

            $plan->update([
              'name'          => $request->name,
              'type'          => $request->type,
              'response'      => $responseArray
            ]);


          Cache::forget("plans");

          return Redirect::route("plans.index")
              ->with([
                  'msg.type'          => 'success',
                  'msg.text'          => "Plan '{$request->name}' was edited successfully!"
              ]);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Plan $plan)
        {
              $plan->delete();

              Cache::forget("plans");

              return Redirect::route("plans.index")
                  ->with([
                      'msg.type'          => 'success',
                      'msg.text'          => "Plan '{$plan->name}' was edited successfully!"
                  ]);
        }
    }
