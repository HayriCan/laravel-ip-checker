<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Driver
    |--------------------------------------------------------------------------
    | Driver option currently supports "db" and "file"
    |
    */

    "driver" => "db",

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
    | Dashboard Settings
    |--------------------------------------------------------------------------
    | If you change 'auth' to true your IpChecker dashboard will require 'auth' middleware
    | You can change  IpChecker dashboard route prefix from 'route_prefix'
    |
    */

    'settings'=>[
        'auth'=> false,
        "route_prefix"=> "",
    ],

    /*
    |--------------------------------------------------------------------------
    | Route Group Middleware
    |--------------------------------------------------------------------------
    | You can specify your 'api.php' and 'web.php' route group middleware for filtering response type.
    |
    |
    */

    'api_middleware'=>'api',
    'web_middleware'=>'web',


    /*
    |--------------------------------------------------------------------------
    | Denied Access Response
    |--------------------------------------------------------------------------
    | Api request denial response will be json, web request denial will be view.
    | You can change the array of api response and you can change message of error page for web response
    |
    */


    'api_response'=>[
        'success'=>false,
        'code'=>250,
        'message'=>'Your IP Address not in the list.',
    ],

    'web_response'=>'Your IP Address not in the list.',



];