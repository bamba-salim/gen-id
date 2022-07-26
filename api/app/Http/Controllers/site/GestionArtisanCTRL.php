<?php

namespace App\Http\Controllers\site;


use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\TransferException;
use Illuminate\Support\Facades\Artisan;
use Throwable;
use function report;
use function response;


class GestionArtisanCTRL extends Controller
{


    public static function migrate()
    {
        return response()->json(ArtisanModel::migrate_app());
    }


    public static function reset()
    {
        return response()->json(ArtisanModel::migrate_reset());

    }

    public static function clear()
    {
        return response()->json(ArtisanModel::clear_app());

    }


}
