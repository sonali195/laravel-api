<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('systemSetting')) {
    function systemSetting($key)
    {
        return DB::table('system_settings')->where('key', $key)->value('value');
    }
}
