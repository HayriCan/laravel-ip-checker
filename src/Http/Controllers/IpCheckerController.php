<?php

namespace HayriCan\IpChecker\Http\Controllers;

use HayriCan\IpChecker\Contracts\IpCheckerInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        if (config('ipchecker.settings.auth')) {
            $this->middleware(['web','auth']);
        }
        else{
            $this->middleware(['web']);
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

        $ipchecker->saveIp(array(
            'group'=>$request->input('group'),
            'definition'=>$request->input('definition'),
            'ip'=>$request->input('ip'),
        ));

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param IpCheckerInterface $ipchecker
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request,IpCheckerInterface $ipchecker)
    {
        $ipchecker->deleteIp($request->input('ipAddress'));

        return redirect()->back();
    }
}
