<?php

/*
 * Clean query strings and protocols from urls
 * Returns only hostname
 */

function cleanReferral($url)
{
    if ($url === null || $url === '') {
        return '';
    }

    $urlClean = implode('.', array_slice(explode('.', parse_url($url, PHP_URL_HOST)), -2));
    if ($urlClean == null) {
        return $url;
    }
    return $urlClean;
}
