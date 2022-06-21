@extends('layouts.app')

@section('content')
    @include('layouts.startUserSidepanel')
    <div class="container-fluid">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Sold</th>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Views</th>
                    <th scope="col">Category</th>
                    <th scope="col">Cloth</th>
                    <th scope="col">price</th>
                    <th scope="col">Creation date</th>
                    <th scope="col">Updated</th>
                </tr>
                </thead>

                <form action="{{route('product.deactivate')}}" method="POST">
                    @foreach($products as $product)

                        <tbody>
                        @csrf
                        <tr>
                                <th><input id="check" type="checkbox" name="check[]" value="{{$product->id}}"></th>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td><a href="{{route('product.show', $product->id)}}">{{$product->title}}</a></td>
                            <td>{{$product->views}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->cloth->name}}</td>
                            <td>€{{$product->price}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->updated_at}}</td>
                        </tr>

                    @endforeach
                    </tbody>

                    <input type="submit" value="Sold">
                </form>
            </table>
    </div>
    @include('layouts.endUserSidepanel')
@endsection
