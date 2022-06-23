@extends('layouts.app')

@section('content')

    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="about-text go-to">
                        <h3 class="dark-color">{{$user->name}}</h3>

                        <div class="row about-list">
                            <div class="col-md-6">

                                <div class="media">
                                    <label>Name</label>
                                    <p>{{$user->name ." ". $user->details->last_name}}</p>
                                </div>
                                <div class="media">
                                    <label>Address</label>
                                    <p>{{$user->details->city->name}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <label>E-mail</label>
                                    <p>{{$user->email}}</p>
                                </div>
                                @if(Auth::user())
                                @if(Auth::id() != $user->id)
                                    <div class="media">
                                        <label>Message me</label>
                                        <p><a href="{{route('messages.create', $user->id)}}">Send message</a></p>
                                    </div>
                                @endif
                                    @else
                                    <p> <a href="{{url('login')}}"> Contact me</a></p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    @if(Auth::user())
                                        @if($user->id != Auth::id())
                                            @if($checkIfRated->isEmpty())
                                                <form method="POST"
                                                      action="{{route('functionality.rateUserForm', $user->id)}}">
                                                    @csrf
                                                    <input type="submit" class="btn btn-success" value="Rate {{$user->name}}">
                                                </form>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-avatar">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                    </div>
                </div>
            </div>
            <div class="counter">
                <div class="row">
                    <div class="col-6 col-lg-3">
                        <div class="count-data user-details">
                            <h6 class="count h2">{{$sold}}</h6>
                            <p class="m-0px font-w-600">Happy Clients</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data user-details">
                            <h6 class="count h2">{{$currently_selling}}</h6>
                            @if($currently_selling > 0)
                            <a href="{{route('product.userListing', $user->id)}}"><p class="m-0px font-w-600">Curently selling</p></a>
                            @else
                                <p class="m-0px font-w-600">Curently selling</p></a>
                                @endif
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data user-details">
                            <h6 class="count h2">{{$user->created_at->format('Y-m-d')}}</h6>
                            <p class="m-0px font-w-600">Selling since</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data user-details">
                            <h6 class="count h2">{{$rating}}</h6>
                            <p class="m-0px font-w-600">Rating</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="about-text go-to">
                        <h2 class="dark-color">Reviews</h2>
                        <div class="row about-list">
                            <div class="col-md-12">
                                @foreach($reviews as $assessment)
                                <div class="media">
                                    <h4>{{$assessment->estimatorDetails->name}}</h4>
                                    <p>{{$assessment->review}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
