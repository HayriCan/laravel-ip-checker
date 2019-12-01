<?php

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Dashboard Translation
    |--------------------------------------------------------------------------
    |
    */
    'ip_list'=>'IP List',
    'add_ip'=>'Add IP Address',
    'group'=>'Group',
    'definition'=>'Definition',
    'ip_address'=>'IP Address',
    'delete_title'=>'Are you sure?',
    'delete_body'=>'Do you really want to delete these ip address? This process cannot be undone!',
    'cancel'=>'Cancel',
    'save'=>'Save',
    'delete'=>'Delete',
    'no_record'=>'No Records',


    /*
    |--------------------------------------------------------------------------
    | Flash Messages
    |--------------------------------------------------------------------------
    |
    */
    'ip_success'=>'IP Address added successfully!',
    'ip_error'=>'IP Address is already in the list!',
    'ip_delete'=>'IP Address has been removed!',

    /*
    |--------------------------------------------------------------------------
    | Denied Access Response
    |--------------------------------------------------------------------------
    | You can change the response code and message from here
    |
    */
    'denied_access'=>[
        'code'=>'250',
        'message'=>'Your IP Address is not defined in the system!',
    ],


];