<?php

class Url
{
    /**
     * Redirect to another URL on the same site
     *
     * @param string $path The path to redirect to
     *
     * @return void
     */
    public static function redirect($path)
    {
        // check the protocol
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }

        // redirecting
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
        exit;
    }
}
