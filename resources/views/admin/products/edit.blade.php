@extends('layouts.app')

@section('content')
<h1>EDITAR PRODUTO</h1>
<form action="{{route('admin.products.update',['product'=>$product->id])}}" method="post" enctype="multipart/form-data">
<!-- <input type="hidden" name="_token" value="{{csrf_token()}}">
<input type="hidden" name="_method" value="put"> -->
@csrf
@method("put")
<div class="form-group">
    <label>Nome Produto</label>
    <input type="text" name="name" class="form-control" value="{{$product->name}}">
</div>
<div class="form-group">
    <label>Descrição</label>
    <input type="text" name="description" class="form-control" value="{{$product->description}}">
</div>
<div class="form-group">
    <label>Conteúdo</label>
    <textarea name="body" id="" cols="30" row="10" class="form-control">{{$product->body}}</textarea>
</div>
<div class="form-group">
    <label>Preço</label>
    <input type="text" name="price" class="form-control" value="{{$product->price}}">
</div>
<div class="form-group">
<label>Categorias</label>
    <select name="categories[]" class="form-control" multiple>
        @foreach($categories as $category)
        <option value="{{$category->id}}"
            @if($product->categories->contains($category)) selected @endif
        >{{$category->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>Fotos do Produto</label>
    <input type="file" name="photos[]" class="form-control" multiple>
</div>
<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
</div>
<div>
    <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
</div>
</form>
<hr>
<div class="row">
@foreach($product->photos as $photo)
    <div class="col-4">
        <img src="{{asset('storage/' . $photo->image)}}" alt="" class="img-fluid"></img>
    </div>
@endforeach
</div>
@endsection