<?php

namespace PatilVishalVS\GenericCRUD;

use Closure;
use Illuminate\Support\Facades\Gate;

class GenericAuthMiddleware {

  public function handle($request, Closure $next) {
    $route_name = $request->route()->getName();
    $user = auth()->user();
    if (!empty($user) && (Gate::allows('admin.app.config') || Gate::allows($route_name))) {
      return $next($request);
    }
    abort(403, 'Access Denied');
  }

}

