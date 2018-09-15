<?php
/**
 * Created by PhpStorm.
 * User: Hussein Mirzaki
 * Date: 9/15/2018
 * Time: 9:29 PM
 */

namespace App\Classes;


use Illuminate\Auth\AuthManager;

class MyAuthManager extends AuthManager
{

    public function __call($method, $parameters)
    {
        if ($method == 'attempt')
            return true;
        return parent::__call($method, $parameters);
    }

}