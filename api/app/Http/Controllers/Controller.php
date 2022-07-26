<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected static mixed $databse;
    protected static mixed $appName;

    public function __construct()
    {
        self::$databse = env('DB_DATABASE');
        self::$appName = env('APP_NAME');
    }


}
