<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogRequestMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        Log::info('HTTP Request', [
            'type' => 'request',
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'headers' => $request->headers->all(),
            'query_params' => $request->query(),
            'request_params' => $request->all(),
        ]);

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        Log::info('HTTP Response', [
            'type' => 'response',
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'status_code' => $response->getStatusCode(),
            'content' => $response->getContent(),
            'response_size' => strlen($response->getContent()),
        ]);
    }
}
