<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function publicDashboardView()
    {
        $devices = Device::all();

        return view('public-dashboard', [
            "devices" => $devices,
        ]);
    }
}
