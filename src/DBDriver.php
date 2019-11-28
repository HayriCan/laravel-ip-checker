<?php

namespace HayriCan\IpChecker;

use HayriCan\IpChecker\Contracts\IpCheckerInterface;

class DBDriver implements IpCheckerInterface{

    /**
     * Model for saving logs
     *
     * @var [type]
     */
    protected $model;
    protected $ipList = [];

    public function __construct(IpList $ipList)
    {
        $this->model = $ipList;
    }

    /**
     * @return array
     */
    public function getIpArray()
    {
        foreach ($this->model->all() as $record){
            array_push($this->ipList,$record->ip);
        }
        $ipList = $this->ipList ?? [];

        return $ipList;
    }

    /**
     * @return IpList[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getIpList()
    {
        return $this->model->all();
    }

    /**
     * @param $array
     * @return bool
     */
    public function saveIp($array)
    {
        $result = IpList::create($array);
        if (!$result){
            return false;
        }

        return true;
    }

    /**
     * @param $ip
     * @return bool
     */
    public function deleteIp($ip)
    {
        $response = false;
        $ipList = IpList::where('ip',$ip)->first();
        if ($ipList){
            IpList::destroy($ipList->id);
            $response = true;
        }

        return $response;
    }
}