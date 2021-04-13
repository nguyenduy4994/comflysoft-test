<?php

namespace App\Http\Controllers;

use App\Facades\PointService;

class DashboardController extends Controller
{
    /**
     * Display a list of point.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.index', [
            'points' => PointService::getWithPaginate(),
        ]);
    }
}
