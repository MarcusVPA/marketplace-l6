<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        dd(session()->get('cart'));
    }

    public function add(Request $request)
    {
        $product = $request->get('product');
        
        //verificar se existe sessao para os produtos
        if(session()->has('cart')){
            // adiciona os produtos na sessão existente
            session()->push('cart',$product); // chave,valor que vai adicionar
        }else{
            // cria a sessão com o primeiro produto
            $products[] = $product;
            session()->put('cart',$products); // chave,valor que vai adicionar
        }
        flash('Produto Adicionado no carinho!')->success();
        return redirect()->route('product.single',['slug'=>$product['slug']]);
    }
}
