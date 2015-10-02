<?php

if (! function_exists('human_filesize')) {
    /**
     * Returns a filesize in human readable format
     *
     * @param  int $bytes
     * @param int  $decimals
     *
     * @return string
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $size   = ['bytes', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb'];
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    function get_lesson_hour_options()
    {
        $base  = [0.25, 0.5, 0.75];
        $hours = $base;
        for ($i = 1; $i <= env('LESSON_MAX_HOURS', 10); $i++) {
            $hours[] = $i;
            foreach ($base as $hour) {
                list($whole, $decimal) = explode('.', $hour);
                $hours[] = $i . '.' . $decimal;
            }
        }

        return $hours;
    }
}