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
            if (in_array(config('ipchecker.api_middleware'),$request->route()->gatherMiddleware())){
                $return_array = config('ipchecker.api_response');

                return response()->json($return_array,250,[],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            }

            $message = config('ipchecker.web_response');

            return response()->view('ipchecker::error',compact('message'));
        }

        return $next($request);
    }
}
