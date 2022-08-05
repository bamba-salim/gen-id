<?php

namespace App\Http\Controllers;


use App\Console\ArtisanRepository;
use App\Http\conf\Controller;


class GestionArtisanCTRL extends Controller
{

    public static function migrate()
    {
        return self::jsonResponse(ArtisanRepository::migrate_app());
    }

    public static function reset()
    {
        return self::jsonResponse(ArtisanRepository::migrate_reset());
    }

    public static function force_reset()
    {
        return self::jsonResponse(ArtisanRepository::migrate_force_reset());
    }

    public static function clear()
    {
        return self::jsonResponse(ArtisanRepository::clear_app());
    }

    public static function refresh(){
        return self::jsonResponse(ArtisanRepository::migrate_refresh());
    }


}
