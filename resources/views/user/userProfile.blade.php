@extends('layouts.app')

@section('content')

    <section class="section about-section gray-bg" id="about">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-6">
                    <div class="about-text go-to">
                        <h3 class="dark-color">{{$user->name}}</h3>
                        <h6 class="theme-color lead">Brand new cloths reseller in Lithuania</h6>
                        <p> Custom text</p>
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
                        <div class="count-data text-center">
                            <h6 class="count h2">{{$sold}}</h6>
                            <p class="m-0px font-w-600">Happy Clients</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2">{{$currently_selling}}</h6>
                            <p class="m-0px font-w-600">Curently selling</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2">{{$user->created_at->format('Y-m-d')}}</h6>
                            <p class="m-0px font-w-600">Selling since</p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="count-data text-center">
                            <h6 class="count h2">{{$rating}}</h6>
                            <p class="m-0px font-w-600">Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
