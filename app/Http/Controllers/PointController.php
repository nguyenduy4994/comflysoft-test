<?php

namespace App\Http\Controllers;

use App\Facades\PointService;
use App\Http\Requests\StorePointRequest;

class PointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($personId)
    {
        return view('pages.point.index', [
            'personId' => $personId,
            'points' => PointService::getByPersonIdWithPaginate($personId),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePointRequest $request, $personId)
    {
        PointService::create($personId, $request->validated());

        return back()->with('status', __('Store success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show($id)
    {
        $point = PointService::findOrFail($id);

        $exposedPoints = PointService::getExposedByPointWithPaginate($point);

        return view('pages.point.show', [
            'currentPoint' => $point,
            'points' => $exposedPoints,
        ]);
    }
}
