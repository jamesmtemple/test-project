<?php namespace App\Http\Middleware;
    use Closure;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;

    class AuthorizeAction
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next, $permission)
        {
            if(! Auth::user()->hasPermission($permission)) {
              return Redirect::back()
                ->with([
                  'msg.type'      => 'danger',
                  'msg.text'      => 'You are not authorized in this action!'
                ]);
            }
            return $next($request);
        }
    }
