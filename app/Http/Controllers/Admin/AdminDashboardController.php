<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TravelGuide;
use App\Models\User;

/**
 * DashboardController
 * @author CK
 */
class AdminDashboardController extends Controller
{
    /**
     * Dashboard
     *
     * @return void
     * @author CK
     */
    public function dashboard()
    {
        $userCount = User::where('role_id', 2)->whereNotNull('password')->count();
        $enquiryCount = TravelGuide::count();
        return view('admin.dashboard', compact('userCount', 'enquiryCount'));
    }
}
