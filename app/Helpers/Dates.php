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


if (! function_exists('formatDateGye')) {
    /**
     * Generate Date Range
     *
     * @return string
     */
    function formatDateGye(): string
    {
        $date = Carbon::now();
       

        return ' ' . $date->day . ' de '. months()[$date->month] . ' del '. $date->year;
    }
}


if (! function_exists('formatDateComplete')) {
    /**
     * Generate Date Range
     *
     * @param $date  => formart d/m/Y
     * @return string
     */
    function formatDateComplete($date ): string
    {
        // dd($date);}
        try {
            $date = Carbon::createFromFormat('d/m/Y', $date);
        } catch (Exception $th) {
            $date = Carbon::create( $date);
        }
       

        return $date->day . ' de '. months()[$date->month] . ' del '. $date->year;
    }
}
