<?php

namespace App\Http\Middleware;

use Closure;
use GeneralKnowledgeTrivia\Domain\Auth\ValueObjects\Token;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Response;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     * @throws \GeneralKnowledgeTrivia\Domain\Auth\Exceptions\InvalidToken
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {

            return response()->json([
                'message'   => 'Unauthorized.',
                'status'    => Response::HTTP_UNAUTHORIZED,
            ], Response::HTTP_UNAUTHORIZED);
        }

        (new Token(auth()->user()->token))->decode();

        return $next($request);
    }
}
