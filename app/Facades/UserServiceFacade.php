<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static create($data)
 */
class UserServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'user_service_facade';
    }
}
