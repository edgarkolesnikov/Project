<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return Redirect::back();
        } else {
            $comment = new Comments();
            $comment->user_id = Auth::id();
            $comment->product_id = $request->post('product_id');
            $comment->content = $request->post('comment');
            $comment->save();
            return Redirect::back();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comments  $comments
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comments::find($id);
        $comment->delete();
        return Redirect::back();
    }
}
