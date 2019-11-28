<?php

namespace HayriCan\IpChecker\Http\Middleware;

use HayriCan\IpChecker\Contracts\IpCheckerInterface;
use Closure;

class IpChecker
{
    protected $allowedIps;

    public function __construct(IpCheckerInterface $ipChecker)
    {
        $this->allowedIps = $ipChecker;
    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        if (!in_array($request->ip(), $this->allowedIps->getIpArray())) {
            $return_array = array(
                'success'=>false,
                'code'=>250,
                'message'=>'Your IP Address not in the list.',
            );
            return response()->json($return_array,250,[],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        }

        return $next($request);
    }
}
