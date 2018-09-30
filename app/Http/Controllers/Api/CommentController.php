<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Rules\TwoWordsUcfirst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
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
            'author'      => ['required', 'string', 'max:255', new TwoWordsUcfirst()],
            'content'     => 'required|string',
            'category_id' => 'nullable|integer',
            'post_id'     => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'messages' => $validator->errors(),
            ]);
        }
        $comment = Comment::create($request->only(['author', 'content', 'category_id', 'post_id']));

        return response()->json([
            'status'  => (bool)$comment,
            'comment' => $comment,
            'message' => $comment ? 'Comment has been created!' : 'Error while creating comment.',
        ]);
    }
}
