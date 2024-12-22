<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cache;
use Illuminate\Support\Facades\DB;

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
    else {
        DB::table('visitor_counts')
            ->where('ip_address', $ip)
            ->update([
                'updated_at' => now(),
            ]);
        }

    // Store the active visitor in the cache with an expiration of 5 minutes
    $expiresAt = now()->addMinutes(5); // Set the active visitor timeout (5 minutes)
    Cache::put('active_visitor:' . $ip, $expiresAt, $expiresAt);  // Store expiration timestamp as value

    

    return $next($request);
}
}
