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

    public function store(Request $request)
    {
        try {
            // Validasi data request
            $request->validate([
                'outlet_id' => 'required|exists:outlets,id',
                'user_id' => 'required|exists:users,id',
                'orders' => 'required|array',
                'orders.*.product_id' => 'required|exists:products,id',
                'orders.*.quantity' => 'required|integer|min:1',
            ]);

            // Simpan data order
            $order = new Order();
            $order->outlet_id = $request->outlet_id;
            $order->user_id = $request->user_id;
            $order->invoice_number = 'INV-' . time(); // Anda dapat mengatur format nomor invoice sesuai kebutuhan
            $order->customer_name = $request->customer_name ?? null; // Jika nama pelanggan tidak disertakan, maka NULL
            $order->amount = 0; // Jumlah awal pesanan
            $order->save();

            // Hitung total amount dari detail pesanan
            $totalAmount = 0;

            // Simpan detail pesanan
            foreach ($request->orders as $orderItem) {
                $detail = new OrderDetail();
                $detail->order_id = $order->id;
                $detail->product_id = $orderItem['product_id'];
                $detail->quantity = $orderItem['quantity'];
                $detail->total = $detail->quantity * $detail->product->price; // Harga per produk bisa diambil dari database atau langsung dari request
                $detail->save();

                $totalAmount += $detail->total;
            }

            // Update total amount pada order
            $order->amount = $totalAmount;
            $order->save();

            // Response JSON untuk sukses
            return response()->json(['message' => 'Order successfully created', 'order' => $order], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangkap pesan validasi
            $errors = $e->validator->errors()->all();

            // Response dengan pesan kesalahan validasi
            return response()->json(['message' => 'Failed to create order: Validation error', 'errors' => $errors], 422);
        }

    }
}
