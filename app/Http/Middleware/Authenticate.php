<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to.
   * https://laravel.com/docs/10.x/authentication#redirecting-unauthenticated-users
   */
  protected function redirectTo(Request $request): string
  {
    return route('login');
  }
}
