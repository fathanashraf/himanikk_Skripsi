<?php

if (!function_exists('settings')) {
    function settings($key, $default = null)
    {
        return \App\Models\Setting::get($key, $default);
    }
}
