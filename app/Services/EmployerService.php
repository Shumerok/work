<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Employer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class EmployerService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();
            $head = $data['head'];
            $imageName = $this->saveAvatar($data['photo'], 'png', 300, 300, 80);
            $data['photo'] = 'avatars/'.$imageName;
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
                Storage::disk('public')->delete($employer->photo);
                $imageName = $this->saveAvatar($data['photo'], 'png', 300, 300, 80);
                $data['photo'] = 'avatars/'.$imageName;
            }
            if (isset($data['head'])) {
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

            if (($employer->isRoot()) && ($employer->children->first() == null)) {
                $employer->delete();
            }

            if ((!$employer->parent) && ($employer->children->first())) {
                $root = $employer->children->first();
                $children = $root->children->first();

                if ($children) {
                    $root->appendNode($children);
                    $root->save();
                }

                $root->makeRoot()->save();
                $employer->delete();
            }

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

            Employer::fixTree();

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
                    ).'"class="btn btn-info btn-sm mr-3 edit id="'.$employees->id.'"> <i class="fas fa-pencil-alt "></i></a>
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

        $response = [];
        foreach ($employees as $employee) {
            $response[] = ["value" => $employee->id, "label" => $employee->name];
        }

        return response()->json($response);
    }

    private function saveAvatar($image, string $format, int $width, int $heigth, int $quality): string
    {
        $ext = '.'.$format;
        $imageName = uniqid().$ext;
        $imageConvert = Image::make($image->getRealPath())->fit($width, $heigth)->encode($format, $quality);
        Storage::disk('public')->put('avatars/'.$imageName, $imageConvert);
        return $imageName;
    }
}

