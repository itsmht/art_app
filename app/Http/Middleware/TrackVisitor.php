<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cache;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();

        // Save unique visitor to the database
        $exists = DB::table('visitor_counts')->where('ip_address', $ip)->exists();
        if (!$exists) {
            DB::table('visitor_counts')->insert([
                'ip_address' => $ip,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Save active visitor to cache
        $expiresAt = now()->addMinutes(5); // Active for 5 minutes
        Cache::put('active_visitor:' . $ip, now(), $expiresAt);

        return $next($request);
    }
}
