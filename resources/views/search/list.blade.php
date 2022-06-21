@extends('layouts.app')

@section('content')
    <h2>Search results</h2>
    <div class="row row-cols-2 row-cols-sm-4">
        <div class="col">
            @foreach($products as $product)
                <div class="card">
                    @foreach($images as $image)
                        @if($product->id == $image['product_id'])
                    <img src="{{$image['image']}}" class="card-img-top" alt="...">
                        @endif
                    @endforeach
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                        <a class="btn btn-primary float-end" href="{{route('product.show', $product->id)}}"> Read
                            more</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
