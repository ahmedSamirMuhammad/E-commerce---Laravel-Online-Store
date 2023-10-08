<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AmazonKeyword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $productName = $request->input('title');
        $categoryName = $request->input('name');

        if (str_contains($productName, 'amazon') || str_contains($categoryName, 'amazon')) {
           
            return redirect()->back()->with('error', 'Kindly remember "amazon" is an invalid keyword.');
        }

        return $next($request);
    }
}
