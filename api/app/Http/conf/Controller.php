<?php

namespace App\Http\conf;

use App\Http\Bean\Error;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use function env;
use function response;

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

    /**
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public static function jsonResponse($data, int $code = 200): JsonResponse
    {
        return response()->json($data, $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

    public static function get_classname($instance): string
    {
        return explode('\\',get_class($instance))[sizeof( explode('\\', get_class($instance))) - 1];
    }

    public static function res_is_error($res): bool
    {
        return is_a($res, Error::class);
    }

}
