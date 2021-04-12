<?php

namespace App\Http\Controllers;

use App\Facades\PeopleService;
use App\Http\Requests\StorePeopleRequest;
use App\Http\Requests\UpdatePeopleRequest;

class PeopleController extends Controller
{
    public function index()
    {
        return view('pages.people.index', [
            'people' => PeopleService::getWithPaginate(),
        ]);
    }

    public function create()
    {
        return view('pages.people.create');
    }

    public function store(StorePeopleRequest $request)
    {
        PeopleService::create($request->validated());

        return redirect()->route('people.index')->with('status', __('Create success'));
    }

    public function edit($id)
    {
        return view('pages.people.edit', [
            'person' => PeopleService::findOrFail($id),
        ]);
    }

    public function update(UpdatePeopleRequest $request, $id)
    {
        PeopleService::update($id, $request->validated());

        return back()->with('status', __('Update success'));
    }
}
