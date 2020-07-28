<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];
        return view('cart',compact('cart')); // manda os itens que vem do carrinho da sessao para a view
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

    public function remove($slug)
    {
        if(!session()->has('cart')){
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');
        $products = array_filter($products,function($line) use($slug){  // "use($slug) é o slug do remove". "array_filter" espera o array a ser filtrado. Pra cada linha desse array vai receber o produto
            return $line['slug'] != $slug;
        });
        session()->put('cart',$products);
        return redirect()->route('cart.index');
    }

    public function cancel()
    {
        session()->forget('cart');

        flash('Compra Cancelada!')->success();
        return redirect()->route('cart.index');
    }
}
