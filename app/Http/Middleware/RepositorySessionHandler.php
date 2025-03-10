<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Repository;

class RepositorySessionHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route()->parameter('repository');
        if (!isset($id)) {
            $request->session()->put('repository_id', '');
            return $next($request);
        }
        if ($request->session()->has('repository_id') && $request->session()->get('repository_id') == $id) {
            return $next($request);
        }
        $repository = Repository::findOrFail($id);
        $name = $repository->name;
        $request->session()->put('repository_id', $id);
        $request->session()->put('repository_name', $name);
        return $next($request);
    }
}
