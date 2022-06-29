<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $messagesData = Messages::where('sender_id', $userId)->orWhere('receiver_id', $userId)->get();
        $messages = [];
        foreach ($messagesData as $message) {
            if ($message->sender_id != $userId) {
                $key = $message->sender_id;
            } else {
                $key = $message->receiver_id;
            }
            $messages[$key] = $message;
        }
        return view('messages.inbox', ['messages' => $messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($receiverId)
    {
        $data['receiver'] = User::find($receiverId);
        return view('messages.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return back()->with('error', 'Message did not send');
        } else {
            $message = new Messages();
            $message->sender_id = Auth::id();
            $message->receiver_id = $request->receiver_id;
            $message->content = $request->post('message');
            $message->status = 1;
            $message->created_at = now();
            $message->save();
            return back()->with('success', 'Message sent');
        }
    }

    public function read($chatFriendId)
    {
        $userId = Auth::id();
        $data['receiver'] = User::find($chatFriendId);
        $data['messages'] = Messages::where('receiver_id', $chatFriendId)
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->where('sender_id', $chatFriendId)
            ->get();
        $unreadMessages = Messages::where('receiver_id', $userId)
            ->where('status', 1)
            ->get();
        foreach ($unreadMessages as $msg) {
            $msg->status = 0;
            $msg->save();
        }
        return view('messages.read', $data);
    }
}
