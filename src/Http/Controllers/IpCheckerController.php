<?php

namespace HayriCan\IpChecker\Http\Controllers;

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

use HayriCan\IpChecker\Contracts\IpCheckerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IpCheckerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web']);
        if (config('ipchecker.settings.auth')) {
            $this->middleware(['web','auth']);
            $this->middleware(function ($request, $next) {
                if (!empty(config('ipchecker.settings.admin_id'))){
                    if (!in_array(Auth::id(),config('ipchecker.settings.admin_id'))){
                        return abort(404);
                    }
                }

                return $next($request);
            });
        }
    }

    /**
     * Show the application dashboard.
     *
     * @param IpCheckerInterface $ipchecker
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(IpCheckerInterface $ipchecker)
    {
        $iplist = $ipchecker->getIpList();

        if(count($iplist)>0){
            $iplist = $iplist->sortByDesc('created_at');
        }

        return view('ipchecker::index',compact('iplist'));
    }

    /**
     * @param Request $request
     * @param IpCheckerInterface $ipchecker
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request,IpCheckerInterface $ipchecker)
    {
        $request_data = $request->all();
        $request_validation = array(
            'group'=>'required|string',
            'definition'=>'required|string',
            'ip'=>'required|ip',
        );
        $validator = Validator::make($request_data, $request_validation);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if (!in_array($request->input('ip'),$ipchecker->getIpArray())){
            $ipchecker->saveIp(array(
                'group'=>$request->input('group'),
                'definition'=>$request->input('definition'),
                'ip'=>$request->input('ip'),
            ));

            return redirect()->back()->with('success',trans('ipchecker::messages.ip_success'));
        }

        return redirect()->back()->with('error',trans('ipchecker::messages.ip_error'));
    }

    /**
     * @param Request $request
     * @param IpCheckerInterface $ipchecker
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request,IpCheckerInterface $ipchecker)
    {
        $ipchecker->deleteIp($request->input('ipAddress'));

        return redirect()->back()->with('info',trans('ipchecker::messages.ip_delete'));
    }
}
