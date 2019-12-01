<?php

namespace HayriCan\IpChecker\Contracts;

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */
interface IpCheckerInterface{

    public function getIpArray();
    /**
     * @return mixed
     */
    public function getIpList();

    public function saveIp($array);

    public function deleteIp($ipAddress);
}