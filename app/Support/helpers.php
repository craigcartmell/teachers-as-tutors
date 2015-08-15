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
}