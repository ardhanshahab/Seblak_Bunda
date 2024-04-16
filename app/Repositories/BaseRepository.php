<?php

namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use File;


class BaseRepository implements BaseRepositoryInterface
{

    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    // CORE FUNCTION
    public function get()
    {
        return $this->model->get();
    }

    public function trashonly()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function restoretrash($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function store($attributes, $isFile = false, $field = null, $folder = null)
    {
        if ($isFile == true) {
            foreach ($field as $key => $value) {
                if (request()->file($value)) {
                    $attributes[$value] = request()->file($value)->store('filemanager/' . $folder, 'public');
                } else if ($attributes[$value]) {
                    $attributes[$value] = $attributes[$value];
                }
            }
        }
        return $this->model->create($attributes);
    }

    public function update($id, $attributes, $isFile = false, $field = null, $folder = null)
    {
        $model = $this->model->find($id);
        if ($isFile == true) {
            if (isset($field)) {
                foreach ($field as $key => $value) {
                    if (request()->file($value)) {
                        File::delete('storage/' . $model[$value]);
                        $attributes[$value] = request()->file($value)->store('filemanager/' . $folder, 'public');
                    }
                }
            }
        }
        $model->update($attributes);
        return $model;
    }

    public function softDelete($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function hardDelete($id, $isFile = false, $field = null)
    {
        $model = $this->model->withTrashed()->find($id);
        if ($isFile == true) {
            File::delete('storage/' . $model[$field]);
        }
        return $model->forceDelete();
    }
    // END CORE FUNCTION

    public function Query()
    {
        return $this->model->query();
    }

};
