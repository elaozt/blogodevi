<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        abort_unless($request->user()?->role === 'OWNER', 403, 'Makale ekleme yalnızca blog sahibine açıktır.');

        return $next($request);
    }
}
