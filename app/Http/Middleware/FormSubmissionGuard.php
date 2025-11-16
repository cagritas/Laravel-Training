<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Blocks the example form submission whenever the banned keyword is provided.
 */
class FormSubmissionGuard
{
    private const BANNED_KEYWORD = 'apple';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->filled('message') && $request->input('message') === self::BANNED_KEYWORD) {
            return redirect()->back();
        }

        return $next($request);
    }
}
