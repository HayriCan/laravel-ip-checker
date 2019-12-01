<?php

namespace HayriCan\IpChecker\Http\Middleware;

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

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
            $code = trans('ipchecker::messages.denied_access.code');
            $message = trans('ipchecker::messages.denied_access.message');

            if (in_array(config('ipchecker.api_middleware'),$request->route()->gatherMiddleware())){
                $return_array = [
                    'success'=>false,
                    'code'=>$code,
                    'message'=>$message,
                ];

                return response()->json($return_array,200,[],JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            }

            return response()->view('ipchecker::error',compact('message','code'));
        }

        return $next($request);
    }
}
