<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static create(array $data)
 * @method static getList(array $data)
 * @method static update(array $data)
 * @method static getPagesCount()
 */
class TaskServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'task_service_facade';
    }
}
