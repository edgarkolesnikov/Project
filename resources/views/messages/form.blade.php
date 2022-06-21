@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Send message to ') . $receiver->name}}</div>
                    <div class="card-body">
                        <form class="form" method="post" action="{{ route('messages.store') }}">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{$receiver->id}}">
                            <div class="col-md-12">
                                <textarea class="form-control" cols="70%" rows="4" name="message"
                                          placeholder="Write Message"></textarea>
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
