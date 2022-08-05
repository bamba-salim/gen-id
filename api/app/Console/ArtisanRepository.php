<?php

namespace App\Console;

use App\Http\Utils\DataBaseConstants;
use Illuminate\Support\Facades\Artisan;

class ArtisanRepository
{


    public static function migrate_reset()
    {
        Artisan::call('migrate:reset');

        $output = self::output_migration();
        if (in_array('Rollbacking', $output)) {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 2)))), "migrations_file" => array_slice($output, 3)];
        } else {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 3))))];
        }
    }

    public static function clear_app()
    {
        Artisan::call("app:clear");
        $final = join(', ', DataBaseConstants::ARTISAN_TO_CLEAR);
        return ["message" => strtoupper("[$final] have been cleared SUCCESSFULLY !")];
    }


    public static function migrate_refresh()
    {
        Artisan::call('migrate:refresh');
        return ["refresh" => self::output_migration()];
    }

    public static function migrate_force_reset()
    {
        Artisan::call('migrate:reset:force');
        return ["refresh" => 'finis'];
    }


    public static function migrate_app()
    {
        Artisan::call('migrate');
        $output = self::output_migration();
        if (in_array('Running', $output)) {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 2)))), "migrations_file" => array_slice($output, 3)];
        } else {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 3))))];
        }
    }


    private static function output_migration()
    {
        $test = explode(" ", Artisan::output());

        $finale = array_filter($test, function ($line) {
            $t = trim($line);
            return !empty(trim($t)) && $t != 'DONE' && !(str_contains($t, 'ms') && strlen($t) < 10) && !(str_contains($t, '.....'));
        });

        return $finale;
    }
}
