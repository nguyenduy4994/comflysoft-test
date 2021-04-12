<?php

namespace App\Http\Controllers;

use App\Facades\PointService;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.index', [
            'points' => PointService::getWithPaginate(),
        ]);
    }
}
