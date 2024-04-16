<?php

namespace App\Http\Controllers\Backend\Master;

use App\DataTables\Master\ProductDatatable;
use App\DataTables\Scopes\Trash\TrashScope;
use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use App\Models\Master\Product;
use App\Models\Master\ProductImage;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    protected $product,$category,$productImage;
    public function __construct(Product $product,Category $category,ProductImage $productImage)
    {
        $this->product = new BaseRepository($product);
        $this->category = new BaseRepository($category);
        $this->productImage = new BaseRepository($productImage);
    }

    public function index(ProductDatatable $datatable)
    {
        return $datatable->render('backend.master.product.index');
    }

    public function create()
    {
        $data['categories'] = $this->category->get();
        return view('backend.master.product.create',compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->merge(['slug' => Str::slug($request->name)]);
        $product = $this->product->store($request->except('images'));
        $data['product_id'] = $product->id;
        foreach($request->images as $images){
            $data['image'] = $images->store('filemanager/product/' . $product->id , 'public');
            $this->productImage->store($data);
        }
        return redirect()->route('master.product.index')->with('success',__('message.store'));
    }

    public function delete($id)
    {
        $this->product->softDelete($id);
        return redirect()->back()->with('success',__('message.softdelete'));
    }

    public function edit($id)
    {
        $data['product'] = $this->product->find($id);
        return view('backend.master.product.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        if(isset($request->image)){
            $this->product->update($id,$request->all(),true,['image'],'product');
        }else{
            $this->product->update($id,$request->all());
        }
        return redirect()->route('master.product.index')->with('success',__('message.update'));
    }

    public function show($id)
    {
        $data['product'] = $this->product->find($id);
        return view('backend.master.product.show',compact('data'));
    }

    public function restore($id)
    {
        $this->product->restoretrash($id);
        return redirect()->route('master.product.index')->with('success',__('message.restore'));
    }

    public function trash(ProductDatatable $datatable)
    {
        return $datatable->addScope(new TrashScope)->render('backend.master.product.trash');
    }

    public function hardDelete($id)
    {
        try {
            $this->product->hardDelete($id);
            return redirect()->back()->with('success', __('message.harddelete'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ($th->getMessage()));
        }
    }

}
