<?php

if (!function_exists('isRequestMethod')) {
    function isRequestMethod($request, $method)
    {
        return strtolower((string) $request->getMethod()) === strtolower((string) $method);
    }
}
