<?php

use Carbon\Carbon;

if (! function_exists('getQuarter')) {
    function getQuarter($date) {
        if (!$date) return null;
        $month = Carbon::parse($date)->month;

        if ($month >= 1 && $month <= 3) return 1;   // Jan–Mar → Triwulan I
        if ($month >= 4 && $month <= 6) return 2;   // Apr–Jun → Triwulan II
        if ($month >= 7 && $month <= 9) return 3;   // Jul–Sep → Triwulan III
        return 4;                                   // Okt–Des → Triwulan IV
    }
}