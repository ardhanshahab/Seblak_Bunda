<?php

namespace App\DataTables\Master;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $data['action'] = $this->actions($query);
                return view('components.actions.button-action', compact('data','query'))->render();
            })
            ->rawColumns(['action','outlet_list']);
    }

    public function actions($id)
    {
        return  [
            [
                'title' => __('button.edit'),
                'icon'  => 'far fa-edit',
                'route' => route('master.user.edit', $id)
            ],
            [
                'title' => __('button.detail'),
                'icon'  => 'far fa-eye',
                'route' => route('master.user.show', $id)
            ],
            [
                'title' => __('button.delete'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.user.delete', $id)
            ],
            [
                'title' => __('button.restore'),
                'icon'  => 'fa fa-undo',
                'route' => route('master.user.restore', $id)
            ],
            [
                'title' => __('button.delete_permanent'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.user.hard-delete', $id)
            ],
        ];
    }

    public function query(User $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('user-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('field.name')),
            Column::make('email')->title(__('field.email')),
            Column::make('role_name')->title(__('field.role')),
            Column::make('outlet_list')->title(__('field.user_outlet')),
            Column::make('action'),
        ];
    }

    protected function filename()
    {
        return 'Master/User_' . date('YmdHis');
    }
}
