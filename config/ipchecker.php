<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    | Driver option currently supports "db" and "file"
    |
    */

    "driver" => "file",

    /*
    |--------------------------------------------------------------------------
    | File Path and File Name
    |--------------------------------------------------------------------------
    | If you switch driver to "file" it will write Allowed Ip Addresses on this path
    |
    */

    "filepath"=>"ipchecker",
    "filename" => "iplist.php",


    /*
    |--------------------------------------------------------------------------
    | Documentation Settings
    |--------------------------------------------------------------------------
    |
    |
    */

    'settings'       => [
        'auth'       => false,
        'middleware' => [
            'web',
        ],
        "route_prefix"=> "",
    ],



];