<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SystemSetting;

class CheckMaintenance
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = SystemSetting::where('id', 1)->first();

        if ($settings) {
            if ($settings->under_maintenance) {
                return response()->json(['status' => 503, 'message' => trans('auth.Under_maintenance'), 'result' => null], 503);
            }

            if ($request->header('AppVersion') !== null && $request->header('Platform') !== null && $request->header('Platform') == 'android' && $settings->android_force_update == 1 && $settings->android_version > $request->header('AppVersion')) {
                return response()->json(['status' => 426, 'message' => trans('auth.Force_update'), 'result' => null], 426);
            }

            if ($request->header('AppVersion') !== null && $request->header('Platform') !== null && $request->header('Platform') == 'iOS' && $settings->ios_force_update == 1 && $settings->ios_version > $request->header('AppVersion')) {
                return response()->json(['status' => 426, 'message' => trans('auth.Force_update'), 'result' => null], 426);
            }
        }

        return $next($request);
    }
}
