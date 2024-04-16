<?php

namespace App\Http\Controllers\Backend\Master;

use App\DataTables\Master\CategoryDatatable;
use App\DataTables\Scopes\CategoryScope;
use App\Http\Controllers\Controller;
use App\Models\Master\Category;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = new BaseRepository($category);
    }

    public function index(CategoryDatatable $datatable)
    {
        
        return $datatable->render('backend.master.category.index');
    }

    public function create()
    {
        return view('backend.master.category.create');
    }

    public function store(Request $request)
    {
        $this->category->store($request->all(),true,['image'],'category');
        return redirect()->route('master.category.index')->with('success',__('message.store'));
    }

    public function delete($id)
    {
        $this->category->softDelete($id);
        return redirect()->back()->with('success',__('message.softdelete'));
    }

    public function edit($id)
    {
        $data['category'] = $this->category->find($id);
        return view('backend.master.category.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        if(isset($request->image)){
            $this->category->update($id,$request->all(),true,['image'],'category');
        }else{
            $this->category->update($id,$request->all());
        }
        return redirect()->route('master.category.index')->with('success',__('message.update'));
    }

    public function show($id)
    {
        $data['category'] = $this->category->find($id);
        return view('backend.master.category.show',compact('data'));
    }

    public function restore($id)
    {
        try {
        $this->category->restoretrash($id);
        return redirect()->route('master.category.index')->with('success',__('message.restore'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ($th->getMessage()));
        }
    }

    public function trash(CategoryDatatable $datatable)
    {
        return $datatable->addScope(new CategoryScope)->render('backend.master.category.trash');
    }

    public function hardDelete($id)
    {
        try {
            $this->category->hardDelete($id, true,'image');
            return redirect()->back()->with('success', __('message.harddelete'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ($th->getMessage()));
        }
    }
}
