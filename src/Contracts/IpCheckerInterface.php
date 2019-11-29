<?php

namespace HayriCan\IpChecker\Contracts;

use Illuminate\Http\Request;

interface IpCheckerInterface{

    public function getIpArray();
    /**
     * @return mixed
     */
    public function getIpList();

    public function saveIp($array);

    public function deleteIp($ipAddress);
}