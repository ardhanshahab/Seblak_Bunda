<?php

namespace App\DataTables\Master;

use App\Models\Master\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $data['action'] = $this->actions($query);
                return view('components.actions.button-action', compact('data','query'))->render();
            })
            ->addColumn('foto', function ($query) {
                return '<img src="' . $query->image_path . '" width="100">';
            })
            ->rawColumns(['action', 'foto']);
    }

    public function actions($id)
    {
        return  [
            [
                'title' => __('button.edit'),
                'icon'  => 'far fa-edit',
                'route' => route('master.category.edit', $id)
            ],
            [
                'title' => __('button.detail'),
                'icon'  => 'far fa-eye',
                'route' => route('master.category.show', $id)
            ],
            [
                'title' => __('button.delete'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.category.delete', $id)
            ],
            [
                'title' => __('button.restore'),
                'icon'  => 'fa fa-undo',
                'route' => route('master.category.restore', $id)
            ],
            [
                'title' => __('button.delete_permanent'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.category.hard-delete', $id)
            ],
        ];
    }

    public function query(Category $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('categorydatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('field.category_name')),
            Column::make('foto'),
            Column::make('action'),
        ];
    }



    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
