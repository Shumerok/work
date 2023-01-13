<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerRequest;
use App\Models\Employer;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployerController extends Controller
{

    public function index()
    {
//        $employees = Employer::get()->toTree();
//
//        $traverse = function ($categories, $prefix = '-') use (&$traverse) {
//            foreach ($categories as $category) {
//                echo PHP_EOL.$prefix.' '.$category->name . " ($category->id)";
//                echo "<br>";
//                $traverse($category->children, $prefix.'-');
//            }
//        };
//
//        $traverse($employees);

        $employees = Employer::all();
//        dd($employees->user->name);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $employees = Employer::all()->pluck('name', 'id')->toArray();

//        dd($employees);
        $positions = Position::all();
        return view('employees.create', compact('positions', 'employees'));
    }

    public function store(EmployerRequest $request)
    {
//        dd($request->toArray());
        $data = $request->validated();
//        dd($data);
        unset($data['head']);
        Employer::firstOrCreate($data);

        return redirect()->route('employees.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Employer $employer)
    {
        $employer->delete();
        return redirect()->route('employees.index');
    }

    /*
   AJAX request
   */
    public function getEmployees(Request $request)
    {
//        dd($request);
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
}
