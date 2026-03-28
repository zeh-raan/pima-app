<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\User;

class APIKeyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $req, Closure $next): Response
    {   

        // Gets API key from request
        $key = $req->header('X-API-KEY');
        if (!$key) {
            return response()->json([
                'error' => 'No API Key!'
            ]);
        }

        $user = User::where('api_key', $key)->first(); // Finds user with that key
        if (!$user) {
            return response()->json([
                'error' => 'Invalid API Key!'
            ]);
        }

        // Authenticate that user
        auth()->setUser($user);
        return $next($req);
    }
}
