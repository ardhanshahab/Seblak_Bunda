<?php

namespace App\Http\Controllers\Backend\Feature;

use App\DataTables\Feature\OrderDatatable;
use App\Http\Controllers\Controller;
use App\Models\Feature\Order;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = new BaseRepository($order);
    }

    public function index(OrderDatatable $datatable)
    {
        return $datatable->render('backend.feature.order.index');
    }

    public function create()
    {
        return view('backend.master.order.create');
    }
}
