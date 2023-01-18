<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employer\StoreRequest;
use App\Http\Requests\Employer\UpdateRequest;
use App\Models\Employer;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{

    public function index()
    {
        $employees = Employer::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $positions = Position::all();
        return view('employees.create', compact('positions'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $head = $data['head'];
        $data['photo'] = Storage::disk('public')->put('/avatars', $data['photo']);
        unset($data['head']);
        $employer = Employer::firstOrCreate($data);

        $employer->parent_id = $head;
        $employer->save();

        return redirect()->route('employers.index');
    }

    public function show($id)
    {
    }

    public function edit(Employer $employer)
    {
        $positions = Position::all();
        return view('employees.edit', compact('employer', 'positions'));
    }

    public function update(UpdateRequest $request, Employer $employer)
    {
        $data = $request->validated();
        $data['photo'] = Storage::disk('public')->put('/avatars', $data['photo']);
        $employer->parent_id = $data['head'];
        unset($data['head']);
        $employer->save();
        $employer->update($data);


        return redirect()->route('employers.index');
    }

    public function destroy(Employer $employer)
    {
        if (!$employer->children->first()) {
            $employer->delete();
        }

        if ($employer->parent && $employer->children->first()) {
            $parent = $employer->parent;
            $children = $employer->children->first();
            $parent->appendNode($children);
            $parent->save();
            $employer->delete();
        }

        if ($employer->isRoot() && $employer->children->first() == null) {
            $employer->delete();
        }


        return redirect()->route('employers.index');
    }

    public function getEmployees(Request $request)
    {
        $search = $request->search;

        if ($search == '') {
            $employees = Employer::orderby('name', 'asc')->select('id', 'name')->limit(5)->get();
        } else {
            $employees = Employer::orderby('name', 'asc')->select('id', 'name')->where(
                'name',
                'like',
                '%'.$search.'%'
            )->limit(5)->get();
        }

        $response = array();
        foreach ($employees as $employee) {
            $response[] = array("value" => $employee->id, "label" => $employee->name);
        }

        return response()->json($response);
    }

    public function buildTree()
    {
        $employees = Employer::withDepth()->get()->toTree();

        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
            foreach ($categories as $category) {
                echo PHP_EOL.$prefix.' '.$category->name." ($category->id) . level = $category->depth";
                echo "<br>";
                $traverse($category->children, $prefix.'-');
            }
        };

        $traverse($employees);
    }
}
