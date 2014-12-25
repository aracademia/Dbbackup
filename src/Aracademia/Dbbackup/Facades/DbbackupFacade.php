<?php
/**
 * Created by PhpStorm.
 * User: rafia
 * Date: 12/24/2014
 * Time: 10:33 PM
 */

namespace Aracademia\Dbbackup\Facades;

use Illuminate\Support\Facades\Facade;

class DbbackupFacade extends Facade {

    protected static function getFacadeAccessor() { return 'Dbbackup'; }

}