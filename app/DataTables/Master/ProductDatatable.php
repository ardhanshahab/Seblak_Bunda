<?php

namespace App\DataTables\Master;

use App\Models\Master\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDatatable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $data['action'] = $this->actions($query);
                return view('components.actions.button-action', compact('data','query'))->render();
            })
            ->addColumn('image', function ($query) {
                return '<img src="' . $query->thumbnail_path . '" width="100">';
            })
            ->rawColumns(['action','image']);
    }

    public function actions($id)
    {
        return  [
            // [
            //     'title' => __('button.edit'),
            //     'icon'  => 'far fa-edit',
            //     'route' => route('master.product.edit', $id)
            // ],
            // [
            //     'title' => __('button.detail'),
            //     'icon'  => 'far fa-eye',
            //     'route' => route('master.product.show', $id)
            // ],
            [
                'title' => __('button.delete'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.product.delete', $id)
            ],
            [
                'title' => __('button.restore'),
                'icon'  => 'fa fa-undo',
                'route' => route('master.product.restore', $id)
            ],
            [
                'title' => __('button.delete_permanent'),
                'icon'  => 'fa fa-trash',
                'route' => route('master.product.hard-delete', $id)
            ],
        ];
    }

    public function query(Product $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('product-datatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax();
    }

    protected function getColumns()
    {
        return [
            Column::make('name')->title(__('field.product_name')),
            Column::make('price_rupiah')->title(__('Harga')),
            Column::make('description')->title(__('Deskripsi')),
            Column::make('image'),
            Column::make('action'),
        ];
    }



    protected function filename()
    {
        return 'Master/Product_' . date('YmdHis');
    }
}
