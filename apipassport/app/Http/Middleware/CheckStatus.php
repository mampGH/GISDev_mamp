<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd($request);

        $response = explode(':', $request->header('Authorization'));
        $token = trim($response[0]);

        //dd($token);
        //$user = Auth::user();

        //$request->validate(['token' => 'filled']);

        if ($token) {
            //if ($user->status) {
                return $next($request);
            //}
        }

        return response()->json('Su cuenta está inactiva');
    }
}
