<?php

if (! function_exists('public_path')) {
    function public_path($path = '')
    {
        return realpath(base_path('../public_html')) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }
}
