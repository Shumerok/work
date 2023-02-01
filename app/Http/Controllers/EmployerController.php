<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employer\StoreRequest;
use App\Http\Requests\Employer\UpdateRequest;
use App\Models\Employer;
use App\Models\Position;
use App\Services\EmployerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployerController extends Controller
{
    private EmployerService $service;

    public function __construct(EmployerService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('employees.index');
    }

    public function create(): View
    {
        $positions = Position::all();
        return view('employees.create', compact('positions'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('employers.index');
    }

    public function edit(Employer $employer): View
    {
        $positions = Position::all();
        return view('employees.edit', compact('employer', 'positions'));
    }

    public function update(UpdateRequest $request, Employer $employer): RedirectResponse
    {
        $data = $request->validated();
        $this->service->update($data, $employer);
        return redirect()->route('employers.index');
    }

    public function destroy($id): void
    {
        $employer = Employer::findOrFail($id);
        $this->service->delete($employer);
    }

    public function getEmployees(Request $request): JsonResponse
    {
        $search = $request->search;
        return $this->service->getAutocompleteData($search);
    }

    public function getAjaxData(): JsonResponse
    {
        $employees = Employer::with('position')->orderBy('id');
        return $this->service->getIndexData($employees);
    }
}
