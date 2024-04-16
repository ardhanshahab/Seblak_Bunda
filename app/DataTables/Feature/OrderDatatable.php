<?php

namespace App\DataTables\Feature;

use App\Models\Feature\Order;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDatatable extends DataTable
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

    public function query(Order $model)
    {
        return $model->newQuery()->with(['Outlet','Cashier']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('order-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    protected function getColumns()
    {
        return [
            Column::make('invoice_number')->title(__('field.order_invoice')),
            Column::make('customer_name')->title(__('field.order_customer')),
            Column::make('outlet.name')->title(__('field.outlet'))->searchable(false),
            Column::make('cashier.name')->title(__('field.order_cashier'))->searchable(false),
            Column::make('amount')->title(__('field.order_total')),
            Column::make('created_at')->title(__('field.created_at')),
            Column::make('action'),
        ];
    }



    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
