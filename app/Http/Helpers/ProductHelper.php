<?php

namespace App\Http\Helpers;

class ProductHelper
{
    public static function formatPartNumber($number)
    {
        $number = preg_replace('/\D/', '', strval($number));

        $length = strlen($number);

        if ($length <= 9) {
            return substr($number, 0, 3) . ' ' . substr($number, 3, 3) . ' ' . substr($number, 6, 3);
        }

        $firstPart = $number[0];
        $remainingParts = substr($number, 1);

        $groups = str_split($remainingParts, 3);

        return $firstPart . ' ' . implode(' ', $groups);
    }
}