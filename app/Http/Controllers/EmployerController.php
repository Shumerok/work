<?php

namespace App\Http\Controllers;

use App\Models\Employer;
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
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function destroy($id)
    {
        //
    }
}
