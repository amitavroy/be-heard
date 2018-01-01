<?php

if (!function_exists('getExcerpt')) {
    function getExcerpt($string, $length = 200, $end = '...')
    {
        // reference from https://stackoverflow.com/questions/35743668/make-an-excerpt-with-php-without-cutt-last-word
        $string = strip_tags($string);

        if (strlen($string) > $length) {
            // truncate string
            $stringCut = substr($string, 0, $length);

            // make sure it ends in a word so assassinate doesn't become ass...
            $string = substr($stringCut, 0, strrpos($stringCut, ' ')).$end;
        }
        return $string;
    }
}
