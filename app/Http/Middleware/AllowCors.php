<?php

namespace App\Http\Middleware;

use Closure;

class AllowCors
{
    /**
     * The headers to set for outgoing responses.
     *
     * @var array
     */
    protected $headers = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE',
        'Access-Control-Allow-Headers' => 'Content-Type, Origin, Authorization',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        foreach ($this->headers as $key => $value) {
            if ($response instanceof \Illuminate\Http\Response) {
                $response->header($key, $value);
            } elseif ($response instanceof \Symfony\Component\HttpFoundation\Response) {
                $response->headers->set($key, $value);
            }
        }

        return $response;
    }
}
