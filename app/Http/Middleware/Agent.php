<?php

namespace App\Http\Middleware;

use Closure;

class Agent
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if (!auth()->user()->is_agent) {
      return redirect()->back();
    }
    return $next($request);
  }
}
