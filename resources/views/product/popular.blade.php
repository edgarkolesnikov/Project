@extends('layouts.app')

@section('content')
        <h2>Todays on trend</h2>
    <div class="row row-cols-1 row-cols-md-3">
        @foreach($products as $product)
            <div class="col-md-3">
                <div class="card h-100">
                    <a href="{{route('product.show', $product->id)}}">
                        @foreach($images as $image)
                            @if($product->id == $image->product_id )
                                <img src="{{URL::to($image->image)}}" class="card-img-top" >
                                @break
                            @endif
                        @endforeach
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">€{{$product->price}}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection
