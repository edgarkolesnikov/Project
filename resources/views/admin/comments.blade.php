@extends('layouts.app')

@section('content')
    @include('layouts.startAdminSidepanel')
    <div class="container-fluid">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User name</th>
                <th scope="col">Product</th>
                <th scope="col">Product Seller</th>
                <th scope="col">Comment</th>

            </tr>
            </thead>

            <form action="{{route('admin.productDelete')}}" method="POST">
                @foreach($comments as $comment)
                    <tbody>
                    @csrf
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <th>{{$comment->user->name}}</th>
                        <th>{{$comment->product->name}}</th>
                        <th>{{$comment->product->user->name}}</th>
                        <th>{{(strlen($comment->content) >35 ? substr($comment->content, 0, 50)."..." : $comment->content)}}</th>


                    </tr>

                    @endforeach
                    </tbody>

                    <input type="submit" value="Delete">
            </form>
        </table>
    </div>
    @include('layouts.endAdminSidePanel')
@endsection
