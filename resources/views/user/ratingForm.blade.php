@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Rate ') . $user->name}}</div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('functionality.rateUser') }}">
                            @csrf

                            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
                                  rel="stylesheet"
                                  integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
                                  crossorigin="anonymous">

                            <div class="container">
                                <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label for="star5" title="5 star">5</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="4 star">4</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="3 star">3</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="2 star">2</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="1 star">1</label>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="col-md-12">
                                <textarea class="form-control" cols="70%" rows="4" name="review"
                                          placeholder="Type Review"></textarea>
                                <input name="button" type="submit" class="btn btn-primary" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
