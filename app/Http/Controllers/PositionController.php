<?php

namespace App\Http\Controllers;

use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Position;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PositionController extends Controller
{
    public function index(): View
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    public function create(): View
    {
        return view('positions.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Position::firstOrCreate($data);
        return redirect()->route('positions.index');
    }

    public function edit(Position $position): View
    {
        return view('positions.edit', compact('position'));
    }

    public function update(UpdateRequest $request, Position $position): RedirectResponse
    {
        $data = $request->validated();
        $position->update($data);
        return redirect()->route('positions.index');
    }

    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();
        return redirect()->route('positions.index');
    }
}
