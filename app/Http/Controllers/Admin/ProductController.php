<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;

    private $product;

    public function __construct(Product $product) {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userStore = auth()->user()->store;
        //$products = $this->product->paginate(10);
        $products = $userStore->products()->paginate(10);
        return view ('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = \App\Category::all(['id','name']);
        return view ('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $data = $request->all();
        //$store = \App\Store::find($data['store']);
        $categories = $request->get('categories', null);
        $store = auth()->user()->store; // atributo é diferente de método, neste caso o "store" é um atributo. Acessa a loja do usuário autenticado
        //$store->products()->create($data);
        $product = $store->products()->create($data); // produto criado para a loja
        $product->categories()->sync($categories); // acessa a ligação de produto com categorias e faz o save
        if($request->hasFile('photos')) {
            // faz a inserção destas imagens (das referência) na base 
            $images = $this->imageUpload($request->file('photos'),'image'); // $request
            //return $product->photos()->createMany($images);
            $product->photos()->createMany($images);
        }
        flash('Produto criado com sucesso.')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        //
        $product = $this->product->findOrFail($product);
        $categories = \App\Category::all(['id','name']);
        return view ('admin.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)
    {
        //
        $data = $request->all();
        $categories = $request->get('categories', null); // chave categories
        $product = $this->product->findOrFail($product);
        $product->update($data);
        if(!is_null($categories)) {
            $product->categories()->sync($categories); // acessa a ligação de produto com categorias e faz o save
        }
        if($request->hasFile('photos')) {
            // faz a inserção destas imagens (das referência) na base 
            $images = $this->imageUpload($request->file('photos'),'image'); // $request
            //return $product->photos()->createMany($images);
            $product->photos()->createMany($images);
        }
        flash('Produto atualizado com sucesso.')->success();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        //
        $product = $this->product->findOrFail($product);
        $product->delete();
        flash('Produto deletado com sucesso.')->success();
        return redirect()->route('admin.products.index');
    }

    /*private function imageUpload(Request $request, $imageColumn)
    {
        $images = $request->file('photos');
        $uploadedImages = [];
        foreach($images as $image){
            $uploadedImages[] = [$imageColumn=>$image->store('products','public')];
        }
        return $uploadedImages;
    } */
}
