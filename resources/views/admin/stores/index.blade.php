@extends('layouts.app')

@section('content')
    @if(!$store)
        <a href="{{route('admin.stores.create')}}" class="btn btn-lg btn-success">Criar Loja</a>
    @endif
<table class="table table-stripped">
    <thead>
        <tr>
            <th>#</th>
            <th>Loja</th>
            <th>Total de Produtos</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <tr>
                <td>{{$store->id}}</td>
                <td>{{$store->name}}</td>
                <td>{{$store->products->count()}}</td>
                <td>
                <!-- <a href="{{route('admin.stores.edit',['store'=>$store->id])}}" class="btn btn-sm btn-primary">EDITAR</a>
                <a href="{{route('admin.stores.destroy',['store'=>$store->id])}}" class="btn btn-sm btn-danger">DELETAR</a> -->
                <div class="btn-group">
                <a href="{{route('admin.stores.edit',['store'=>$store->id])}}" class="btn btn-sm btn-primary">EDITAR</a> <!-- id é o nome do parametro -->
                <form action="{{route('admin.stores.destroy',['store'=>$store->id])}}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-sm btn-danger">DELETAR</button>
                </form>
                </div>
                </td>
            </tr>
        </tr>
    </tbody>
</table>

@endsection