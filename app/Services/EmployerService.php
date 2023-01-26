<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Employer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class EmployerService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $head = $data['head'];
            $data['photo'] = Storage::disk('public')->put('/avatars', $data['photo']);
            unset($data['head']);
            $employer = Employer::firstOrCreate($data);

            $employer->parent_id = $head;
            $employer->save();
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $employer)
    {
        try {
            DB::beginTransaction();
            if (isset($data['photo'])) {
                $data['photo'] = Storage::disk('public')->put('/avatars', $data['photo']);
            }
            if (isset($data['head'])){
                $employer->parent_id = $data['head'];
                unset($data['head']);
            }
            $employer->save();
            $employer->update($data);

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function delete(Employer $employer)
    {
        try {
            DB::beginTransaction();
            if (!$employer->children->first()) {
                $employer->delete();
            }

            if (($employer->parent) && $employer->children->first()) {
                $parent = $employer->parent;
                $children = $employer->children->first();
                $parent->appendNode($children);
                $parent->save();
                $employer->delete();
            }

            if (($employer->isRoot()) && ($employer->children->first() == null)) {
                $employer->delete();
            }else{
                $employer->children->first()->makeRoot()->save();
                $employer->delete();
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function getIndexData($employees): JsonResponse
    {
        return Datatables::of($employees)
            ->addColumn('action', function ($employees) {
                return '<a href="'.route(
                        'employers.edit',
                        $employees->id
                    ).'"class="btn btn-info btn-sm mr-3 edit id="'.$employees->id.'"><i class="fas fa-pencil-alt mr-1"></i> </a>
                        <button type="button" name="'.$employees->name.'" id="'.$employees->id.'" class="delete btn btn-danger btn-sm"> <i class="fas fa-trash mr-1 " role="button"></i></button>';
            })->make();
    }

    public function getAutocompleteData($search): JsonResponse
    {
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

