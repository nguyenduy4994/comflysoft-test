<?php

namespace App\Http\Controllers;

use App\Facades\PeopleService;
use App\Http\Requests\StorePeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.people.index', [
            'people' => PeopleService::getWithPaginate(),
        ]);
    }

    /**
     * Display a form to create resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.people.create');
    }

    /**
     * Store the created resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePeopleRequest $request)
    {
        PeopleService::create($request->validated());

        return redirect()->route('people.index')->with('status', __('Create success'));
    }

    /**
     * Show edit form of resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.people.edit', [
            'person' => PeopleService::findOrFail($id),
        ]);
    }

    /**
     * Update the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePeopleRequest $request, $id)
    {
        PeopleService::update($id, $request->validated());

        return back()->with('status', __('Update success'));
    }
}
