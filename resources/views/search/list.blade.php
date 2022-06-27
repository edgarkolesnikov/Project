@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Search results</h2>
        <div class="row row-cols-1 row-cols-md-3">
            @foreach($products as $product)
                <div class="col-md-3">
                    <div class="card h-100">
                        @foreach($images as $image)
                            @if($product->id == $image['product_id'])
                                <img src="{{$image['image']}}" class="card-img-top" alt="...">
                            @endif
                        @endforeach
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <p class="card-text">€{{$product->price}}</p>
                            <a class="btn btn-primary float-end" href="{{route('product.show', $product->id)}}"> Read
                                more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
