<?php

namespace App\Http\Helpers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;

class GlobalHelper
{
    public static function formatPhoneNumber($phoneNumber)
    {
        $formattedPhoneNumber = null;

        if (Str::startsWith($phoneNumber, '0')) {
            $formattedPhoneNumber = Str::replaceFirst('0', '254', $phoneNumber);
        }

        if (Str::startsWith($phoneNumber, '+254')) {
            $formattedPhoneNumber = Str::replaceFirst('+', '', $phoneNumber);
        }

        if (Str::startsWith($phoneNumber, '7') || Str::startsWith($phoneNumber, '1')) {
            $formattedPhoneNumber = Str::of($phoneNumber)->prepend('254');
        }

        if (Str::startsWith($phoneNumber, '254')) {
            $formattedPhoneNumber = $phoneNumber;
        }

        return $formattedPhoneNumber;
    }

    public static function getDurationDates($period = 'today')
    {
        $startDate = null;
        $endDate = null;

        switch ($period) {
            case 'yesterday':
                $startDate = now()->subday();
                $endDate = now()->subday();
                break;
            case 'today':
                $startDate = now();
                $endDate = now();
                break;
            case 'this-week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                break;
            case 'this-month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            default:
                $startDate = now();
                $endDate = now();
                break;
        }

        return [$startDate, $endDate];
    }

    public static function getDateRanges($startDate, $endDate)
    {
        $period = CarbonPeriod::create($startDate, $endDate);

        $periods = $period->toArray();

        $periods = array_map(fn($period) => $period->format('Y-m-d'), $periods);

        return $periods;
    }

    public static function getOracleDate(string $dateArray)
    {
        return Carbon::parse("{$dateArray[0]}-{$dateArray[1]}-{$dateArray[2]}")->format('Y-m-d');
    }
    /**
     * alpha: 0=alphanumeric, 1=alpha only, 2= numbers
     * upperCase: 0=mixed case, 1=no upper, 2=all uppercase.
     *
     **/
    public static function randomString($length = 5, $alpha = 0, $upperCase = 0, $excludeChars = '')
    {
        $az = 'abcdefghijklmnopqrstuvwyz';
        $nums = '1234567890';

        $pool = match ($alpha) {
            0 => $az . $nums,
            1 => $az,
            2 => $nums
        };

        if (!$alpha == 2) {
            $pool = match ($upperCase) {
                0 => $pool . strtoupper($az),
                1 => $pool,
                2 => strtoupper($pool)
            };
        }

        if ($excludeChars) {
            $excludeArray = str_split($excludeChars);
            $pool = str_replace($excludeArray, '', $pool);
        }

        return substr(str_shuffle($pool), 0, $length);
    }

    public static function formatBoschAndChildrenBrands($brands)
    {
        // Find Bosch brand
        $boschBrand = array_filter($brands, function ($brand) {
            return strtolower($brand['name']) === 'bosch';
        });

        if (empty($boschBrand)) {
            return [];
        }

        $boschBrand = reset($boschBrand);
        $boschId = $boschBrand['id'];
        $childBrands = self::getAllChildBrands($boschId, $brands);

        return array_merge([$boschId], array_column($childBrands, 'id'));
    }

    private static function getAllChildBrands($parentId, $brands)
    {
        $directChildren = array_filter($brands, function ($brand) use ($parentId) {
            return $brand['parent_id'] == $parentId;
        });

        $allChildren = $directChildren;

        foreach ($directChildren as $child) {
            $allChildren = array_merge($allChildren, self::getAllChildBrands($child['id'], $brands));
        }

        return $allChildren;
    }

    public static function formatAndSetPartNumber($partNumber, $isBoschSelected)
    {
        if ($isBoschSelected) {
            $formattedPartNumber = self::formatPartNumber(preg_replace('/\s+/', '', substr($partNumber, 0, 10)));
            return $formattedPartNumber;
        } else {
            return preg_replace('/\s+/', '', $partNumber);
        }
    }

    private static function formatPartNumber($partNumber)
    {
        $length = strlen($partNumber);

        if ($length <= 1) {
            return $partNumber;
        }

        if ($length <= 4) {
            return substr($partNumber, 0, 1) . ' ' . substr($partNumber, 1);
        }

        if ($length <= 7) {
            return substr($partNumber, 0, 1) . ' ' . substr($partNumber, 1, 3) . ' ' . substr($partNumber, 4);
        }

        return substr($partNumber, 0, 1) . ' ' . substr($partNumber, 1, 3) . ' ' . substr($partNumber, 4, 3) . ' ' . substr($partNumber, 7);
    }
}