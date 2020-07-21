<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    //criado
    public function __construct() {
        $this->middleware('user.has.store')->only(['create','store']);
    }

    public function index() {
        //$stores = \App\Store::paginate(10);
        //return $stores;
        $store = auth()->user()->store;
        //return view('admin.stores.index',compact('stores'));
        return view('admin.stores.index',compact('store'));
    }

    public function create() {
        $users = \App\User::all(['id','name']);
        return view('admin.stores.create',compact('users'));
    }

    public function store(StoreRequest $request) {
        $data = $request->all();
        $user = auth()->user();
        //$user = \App\User::find($data['user']);
        $store = $user->store()->create($data);
        //return $store;
        flash('Loja criada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store) {
        $store = \App\Store::find($store);
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store) {
        $data = $request->all();
        $store = \App\Store::find($store);
        $store->update($data);
        //return $store;
        flash('Loja atualizada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store) {
        $store = \App\Store::find($store);
        $store->delete();
        //return redirect('admin/stores');
        flash('Loja deletada com sucesso')->success();
        return redirect()->route('admin.stores.index');
    }
}
