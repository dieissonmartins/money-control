<?php
declare(strict_types=1);

namespace Src;

class Utils {

    public static function dateParse($date): string
    {
        //DD/MM/YYYY -> YYYY-MM-DD
        $dateArray = explode('/', $date);
        //[ dd, mm, yyyy]
        $dateArray = array_reverse($dateArray);
        //[ yyyy, mm, dd]
        return implode('-', $dateArray);
    }

    public static function numberParse($number): array|string
    {
        //1.000,50 -> 1000.50
        $newNumber = str_replace('.', '', $number);
        $newNumber = str_replace(',', '.', $newNumber);
        return $newNumber;
    }
}
