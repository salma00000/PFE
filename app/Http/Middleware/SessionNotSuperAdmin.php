<?php
    namespace App\Http\Middleware;
    use Closure;
    use Illuminate\Http\Request;
    use Symfony\Component\HttpFoundation\Response;

    class SessionNotSuperAdmin{
        /**
         * Handle an incoming request.
         *
         * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
         */
        public function handle(Request $request, Closure $next){
            if(Session()->has("email") && auth()->user()->role != "Super Admin"){
                return back();
            }

            else if(!Session()->has("email")){
                return back();
            }
            
            return $next($request);
        }
    }
?>
