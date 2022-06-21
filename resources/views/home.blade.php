@extends('layouts.app')

@section('content')
    <a class="nav-link" href="{{route('popular.products')}}">
    <h2>Todays on trend</h2>
    </a>
    <div class="row row-cols-1 row-cols-md-12">
        @foreach($popularProducts as $popularProduct)
            <div class="col-md-3">
                <div class="card h-100">
                    <a href="{{route('product.show', $popularProduct->id)}}">
                    @foreach($images as $image)
                        @if($popularProduct->id == $image->product_id )
                            <img src="{{$image->image}}" class="card-img-top" >
                            @break
                        @endif
                    @endforeach
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$popularProduct->title}}</h5>
                        <p class="card-text">{{$popularProduct->description}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">€{{$popularProduct->price}}</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <a class="nav-link" href="{{route('newest.products')}}">
    <h2>Newest products</h2>
    </a>
    <div class="row row-cols-1 row-cols-md-3">
        @foreach($newProducts as $newProduct)
            <div class="col-md-3">
                <div class="card h-100">
                    <a href="{{route('product.show', $newProduct->id)}}">
                    @foreach($images as $image)
                        @if($newProduct->id == $image->product_id )
                            <img src="{{URL::asset($image->image)}}" class="card-img-top">
                            @break
                        @endif

                    @endforeach
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">{{$newProduct->title}}</h5>
                        <p class="card-text">{{$newProduct->description}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text">€{{$newProduct->price}}</small>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection
