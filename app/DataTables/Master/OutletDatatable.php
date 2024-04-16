<?php

namespace App\DataTables\Master;

use App\Models\Master\Outlet;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OutletDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $data['action'] = $this->actions($query);
                return view('components.actions.button-action', compact('data','query'))->render();
            })
            ->rawColumns(['action']);
    }

    public function actions($id)
    {
        return  [
            [
                'title' => __('button.edit'),
                'icon'  => 'far fa-edit',
                'route' => route('master.outlet.edit', $id)
            ],
            [
                'title' => __('button.detail'),
                'icon'  => 'far fa-eye',
                'route' => route('master.outlet.show', $id)
            ],
            [
                'title' => __('button.delete'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.outlet.delete', $id)
            ],
            [
                'title' => __('button.restore'),
                'icon'  => 'fa fa-undo',
                'route' => route('master.outlet.restore', $id)
            ],
            [
                'title' => __('button.delete_permanent'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.outlet.hard-delete', $id)
            ],
        ];
    }

    public function query(Outlet $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('outlet-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('field.outlet_name')),
            Column::make('address')->title(__('field.outlet_address')),
            Column::make('action'),
        ];
    }



    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
