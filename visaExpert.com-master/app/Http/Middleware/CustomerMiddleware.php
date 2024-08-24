<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->user_type == UserType::CUSTOMER->toString()) {
            return $next($request);
        }

        if ($user && $user->user_type == UserType::ADMIN->toString()) {
            return redirect()->route('admin.dashboard')->with('error', 'Unauthorized access.');
        }

        return redirect()->route('login')->with('error', 'Unauthorized access.');
    }
}
