<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        if (Auth::user()->role !== $role) {
            $fallback = Auth::user()->role === 'admin'
                ? route('admin.dashboard')
                : route('user.dashboard');
            return redirect($fallback)
                ->with('error', 'Bạn không có quyền truy cập trang này.');
        }
        return $next($request);
    }
}
