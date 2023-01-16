<?php

namespace App\Http\Controllers;

use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Position;

class PositionController extends Controller
{

    public function index()
    {
        $positions = Position::all();

        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Position::firstOrCreate($data);
        return redirect()->route('positions.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(UpdateRequest $request, Position $position)
    {
        $data = $request->validated();
        $position->update($data);
        return redirect()->route('positions.index');
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index');
    }
}
