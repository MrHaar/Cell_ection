<?php

/**
 * @file EncryptCookies.php
 */

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

/**
 * @class EncryptCookies
 */
class EncryptCookies extends Middleware //automatically created by Laravel
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}