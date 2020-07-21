@extends('layouts.app')

@section('content')
<a href="{{route('admin.products.create')}}" class="btn btn-lg btn-success">Criar Produto</a>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Loja</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>R$ {{number_format($product->price, 2, ',', '.')}}</td> <!-- formatação pra preço -->
                <td>{{$product->store->name}}</td>
                <td>
                <div class="btn-group">
                <a href="{{route('admin.products.edit',['product'=>$product->id])}}" class="btn btn-sm btn-primary">EDITAR</a> <!-- product é o nome do parametro -->
                <!-- <a href="{{route('admin.products.destroy',['product'=>$product->id])}}" class="btn btn-sm btn-danger">DELETAR</a> -->
                <form action="{{route('admin.products.destroy',['product'=>$product->id])}}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-sm btn-danger">DELETAR</button>
                </form>
                </div>
                </td>
            </tr>
            @endforeach
        </tr>
    </tbody>
</table>

{{$products->links()}} <!-- ajuda na paginação -->

@endsection