<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Ensure the current user is authenticated and an admin.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user || ! ($user->is_admin ?? false)) {
            return redirect()->to('/admin/login');
        }

        return $next($request);
    }
}

