<?php

namespace App\Http\Controllers\Backend\Feature;

use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use App\Models\Master\Product;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index()
    {
        $data['product']  = Product::all();
        $data['category'] = Category::all();
        return view('backend.feature.cashier.index',compact('data'));
    }
}
