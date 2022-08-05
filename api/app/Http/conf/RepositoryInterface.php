<?php

namespace App\Http\conf;

interface RepositoryInterface
{
    public static function find($id);
    public static function getAll();
    public static function add($Model);
    public static function remove($id);
    public static function set($model);
    public static function saveOrUpdate($model);

}
