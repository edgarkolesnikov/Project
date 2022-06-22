@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inbox') }}</div>
                    <div class="card-body">
                    @foreach($messages as $chatFriendId => $message)

                            <div class="message-wrapper">
                                <div class="chat-friend
                                    {{($message->status === 1) ? 'unread' : 'read'}}
                                    ">
                                    @if($message->sender_id == $chatFriendId)
                                        {{$message->sender->name}}
                                    @else
                                        {{$message->receiver->name}}
                                    @endif
                                    <hr>
                                    <p>{{$message->content}}</p>
                                    <a href="{{route('messages.read', $chatFriendId)}}">Read more..</a>
                                </div>
                            </div>
                        <hr>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
