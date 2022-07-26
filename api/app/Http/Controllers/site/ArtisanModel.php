<?php

namespace App\Http\Controllers\site;

use Illuminate\Support\Facades\Artisan;

class ArtisanModel
{

    private static function output()
    {
        $test = explode(" ", Artisan::output());

        $finale = array_filter($test, function ($line) {
            $t = trim($line);
            return !empty(trim($t)) && $t != 'DONE' && !(str_contains($t, 'ms') && strlen($t) < 10) && !(str_contains($t, '.....'));
        });

        return $finale;
    }

    public static function migrate_app()
    {
        Artisan::call('migrate');
        $output = self::output();
        if (in_array('Running', $output)) {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 2)))), "migrations_file" => array_slice($output, 3)];
        } else {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 3))))];
        }
    }


    public static function migrate_reset()
    {
        Artisan::call('migrate:reset');

        $output = self::output();
        if (in_array('Rollbacking', $output)) {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 2)))), "migrations_file" => array_slice($output, 3)];
        } else {
            return ['success' => strtoupper(str_replace('.', ' !', join(' ', array_slice($output, 1, 3))))];
        }
    }

    public static function clear_app()
    {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        return ["success" => strtoupper(str_replace('.', ' !', join(' ', array_slice(self::output(), 2))))];

    }



    public static function migrate_refresh()
    {
        Artisan::call('migrate:refresh');
        return ["refresh" => self::output()];
    }



}
