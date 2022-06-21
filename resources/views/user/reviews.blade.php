@extends('layouts.app')

@section('content')
    @include('layouts.startUserSidepanel')
    <div class="container-fluid">
        <table class="table" style="text-align: left">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Review</th>
                <th scope="col">Rating</th>
            </tr>
            </thead>
            @foreach($reviews as $review)
                <tbody>
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    @if($review->review == null)
                        <td> -</td>
                    @else
                        <td>{{$review->review}}</td>
                    @endif
                    @if($review->grade == null)
                        <td> -</td>
                    @else
                        <td>{{$review->grade}}</td>
                    @endif
                </tr>

                @endforeach
                </tbody>
        </table>
    </div>

    @include('layouts.endUserSidepanel')
@endsection
