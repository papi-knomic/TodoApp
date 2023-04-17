<?php

namespace App\Http\Middleware;

use App\Traits\Response;
use Closure;
use Illuminate\Http\Request;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ( ! $request->user()->is_admin ) {
            return Response::errorResponse('You can not carry out this action');
        }
        return $next($request);
    }
}
