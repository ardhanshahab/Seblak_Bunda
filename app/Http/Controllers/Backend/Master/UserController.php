<?php

namespace App\Http\Controllers\Backend\Master;

use App\DataTables\Master\UserDatatable;
use App\DataTables\Scopes\Trash\TrashScope;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = new BaseRepository($user);
    }

    public function index(UserDatatable $datatable)
    {
        return $datatable->render('backend.master.user.index');
    }

    public function create()
    {
        return view('backend.master.user.create');
    }

    public function store(Request $request)
    {
        $this->user->store($request->all());
        return redirect()->route('master.user.index')->with('success',__('message.store'));
    }

    public function delete($id)
    {
        $this->user->softDelete($id);
        return redirect()->back()->with('success',__('message.softdelete'));
    }

    public function edit($id)
    {
        $data['user'] = $this->user->find($id);
        return view('backend.master.user.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        if(isset($request->image)){
            $this->user->update($id,$request->all(),true,['image'],'user');
        }else{
            $this->user->update($id,$request->all());
        }
        return redirect()->route('master.user.index')->with('success',__('message.update'));
    }

    public function show($id)
    {
        $data['user'] = $this->user->find($id);
        return view('backend.master.user.show',compact('data'));
    }

    public function restore($id)
    {
        $this->user->restoretrash($id);
        return redirect()->route('master.user.index')->with('success',__('message.restore'));
    }

    public function trash(userDatatable $datatable)
    {
        return $datatable->addScope(new TrashScope)->render('backend.master.user.trash');
    }

    public function hardDelete($id)
    {
        try {
            $this->user->hardDelete($id, true,'image');
            return redirect()->back()->with('success', __('message.harddelete'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', ($th->getMessage()));
        }
    }
}
