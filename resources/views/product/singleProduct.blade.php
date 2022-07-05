@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$product->title}}</div>
                <div class="card-body">
                    <div class="row photos">
                        @foreach($images as $image)
                            <div class="col-sm-6 col-md-4 col-lg-3 item">
                                <a href="{{URL::to($image->image)}}" data-lightbox="photos">
                                    <img class="card-img-top" src="{{URL::to($image->image)}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                    <div class="col">
                    <ul>
                        <li>{{$product->category->name}}</li>
                        <li>{{$product->cloth->name}}</li>
                        <li>{{$product->color->name}}</li>
                        <li>{{$product->brand->name}}</li>
                        <li>{{$product->size->name}}</li>
                        <li>{{$product->material->name}}</li>
                        <li><h2 style="color:green">€{{$product->price}}</h2></li>
                    </ul>
                    </div>
                    <div class="col" style="background: whitesmoke">
                        <h3>{{$product->description}}</h3>
                    </div>
                    </div>

                    @if(Auth::id() != $product->user_id)
                        <h4> Seller: <a
                                href="{{route('user.profile', $product->user->id)}}">{{$product->user->name}}</a>
                        </h4>
                    @endif

                    @if(Auth::user())
                        @if($product->user_id == Auth::id())
                            <a class="btn btn-primary float-end" href="{{route('product.edit', $product->id)}}">Edit
                                post</a>
                        @else
                            <a class="btn btn-primary float-end"
                               href="{{route('messages.create', $product->user_id)}}">
                                Contact
                            </a>
                        @endif
                    @endif
                    @if(Auth::user())
                        @if($product->user_id != Auth::id())
                            @if($favoredProduct->isEmpty())
                                <form class="form" method="POST"
                                      action="{{route('favouriteProduct', $product->id)}}">
                                    @csrf
                                    @method('GET')
                                    <input type="submit" value="Favourite" class="btn btn-primary float-start">
                                </form>
                            @else
                                <form class="form" method="POST"
                                      action="{{route('unfavouriteProduct', $product->id)}}">
                                    @csrf
                                    @method('GET')
                                    <input type="submit" value="Delete from watchlist"
                                           class="btn btn-danger float-start">
                                </form>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-100 mb-100">
        <div class="col-lg-6">
            <div class="card-body text-center">
                @if(Auth::user())
                    <form class="form" method="post" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <textarea maxlength="255" class="text-center" cols="70%" name="comment"
                                  placeholder="Comment"></textarea>
                        <input name="button" type="submit" class="btn btn-primary" value="Comment">
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mt-100 mb-100">
        <div class="col-lg-6">
            <div class="card-body text-center">
                <h4 class="card-title">Latest Comments</h4>
            </div>
            @foreach($comments as $comment)
                <div class="comment-widgets">
                    <div class="d-flex flex-row comment-row m-t-0">
                        <div class="comment-text w-100">
                            <h6 class="font-medium"><h2>{{$comment->user->name}}</h2></h6>
                            <span
                                class="m-b-15 d-block"><h5>{{$comment->content}}</h5></span>

                            @if($comment->user_id == Auth::id())
                                <form class="form" method="POST"
                                      action="{{route('comments.destroy', $comment->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete-button-right">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </form>
                            @endif
                            <div class="comment-footer"><span
                                    class="text-muted float-right">{{$comment->created_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
@endsection
