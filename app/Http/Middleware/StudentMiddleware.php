<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
  /**
   ** Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $authHeader = $request->header('X-AUTH-HEADER');

    if (!$authHeader) {
      return response()->json([
        'message' => 'User not authorized',
        'status' => 403
      ], 403);
    }

    return $next($request);
  }
}
