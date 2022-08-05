<?php

namespace App\Utils;

use Carbon\Carbon;

class DateUtils
{
    const FORMAT_YYYY_MM_DD = 'Y-m-d';
    const FORMAT_YYYY_MM_DD_HH_MM_SS = 'Y-m-d H:i:s';

    public static function date_now(){
        return Carbon::now();
    }

    public static function addDays($inpurDate, $inputDateFomat, $daysToAdd = 1){
        return Carbon::createFromFormat($inputDateFomat, $inpurDate)->addDays($daysToAdd);
    }


    public static function formatFromDB($date){
        return Carbon::createFromFormat(self::FORMAT_YYYY_MM_DD_HH_MM_SS, $date);
    }

}
