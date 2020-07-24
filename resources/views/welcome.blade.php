@extends('layouts.front')

@section('content')
    
    @foreach($products as $product)
    <div class="card">
        <img src="" alt="" class="card-img-top">
        <div class="card-body">
            <h2 class="card-tittle">{{$product->name}}</h2>
            <p class="card-text">
                {{$product->description}}
            </p>
        </div>
    </div>
    @endforeach

@endsection