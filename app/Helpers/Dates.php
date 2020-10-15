<?php

use Carbon\Carbon;

if (! function_exists('carbonNow')) {
    /**
     * Get Carbon Now datetime
     *
     * @return Carbon
     */
    function carbonNow(): Carbon
    {
        return Carbon::now();
    }
}

if (! function_exists('validateDate')) {
    /**
     * Validate Date
     *
     * @param $date
     * @param string $format
     * @return bool
     */
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}

if (! function_exists('dateFormat')) {
    /**
     * Parse a string to date format
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    function dateFormat($date, string $format = 'd-m-Y'): string
    {
        if ($date !== null && $date !== '') {
            return Carbon::parse($date)->format($format);
        }
    }
}

if (! function_exists('diffForHumans')) {
    /**
     * Diff For Humans
     *
     * @param $rawDate
     * @return string
     */
    function diffForHumans($rawDate)
    {
        if ($rawDate !== null && $rawDate !== '') {
            try {
                return Carbon::parse($rawDate)->diffForHumans();
            } catch (Exception $e) {
                echo 'Invalid date for: ' . $rawDate;
            }
        }
    }
}

if (! function_exists('dateForHumans')) {
    /**
     * Date For Humans
     *
     * @param $rawDate
     * @param bool $inverted
     * @return string
     */
    function dateForHumans($rawDate, $inverted = false)
    {
        if ($rawDate !== null && $rawDate !== '') {
            $date = Carbon::parse($rawDate);

            if (! $inverted) {
                return '<span data-toggle="tooltip" title="' . diffForHumans($date) . '">' . $date . '</span>';
            }

            return '<span data-toggle="tooltip" title="' . $date . '">' . diffForHumans($date) . '</span>';
        }
    }
}

if (! function_exists('months')) {
    /**
     * Months in array
     *
     * @return array
     */
    function months(): array
    {
        return [
            1   => 'Enero',
            2   => 'Febrero',
            3   => 'Marzo',
            4   => 'Abril',
            5   => 'Mayo',
            6   => 'Junio',
            7   => 'Julio',
            8   => 'Agosto',
            9   => 'Septiembre',
            10  => 'Octubre',
            11  => 'Noviembre',
            12  => 'Diciembre'
        ];
    }
}

if (! function_exists('days')) {
    /**
     * Get days
     *
     * @return array
     */
    function days(): array
    {
        $from   = 1;
        $to     = 31;

        return range($from, $to);
    }
}

if (! function_exists('years')) {
    /**
     * Get years
     *
     * @return array
     */
    function years(): array
    {
        $from   = Carbon::now()->subYears(18)->year;
        $to     = Carbon::now()->subYears(100)->year;

        return range($from, $to);
    }
}

if (! function_exists('yearsOld')) {
    /**
     * Get years between a number
     *
     * @param int $yearsBetween
     * @return array
     */
    function yearsOld(int $yearsBetween = 1): array
    {
        $initialYear    = 2019;
        $currentYear    = Carbon::now()->year;
        $farthestYear   = Carbon::now()->addYears($yearsBetween)->year;

        $yearsUp        = range($farthestYear, $currentYear);
        $yearsDown      = range($currentYear, $initialYear);

        return array_unique(array_merge($yearsUp, $yearsDown));
    }
}

if (! function_exists('generateDateRange')) {
    /**
     * Generate Date Range
     *
     * @param $start_date
     * @param $end_date
     * @return array
     */
    function generateDateRange($start_date, $end_date): array
    {
        $start_date = Carbon::createFromFormat('Y-m-d', $start_date);
        $end_date   = Carbon::createFromFormat('Y-m-d', $end_date);

        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }
}
