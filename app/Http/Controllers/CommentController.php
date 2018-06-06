<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->get('body')
        ]);

        auth()->user()->assign('author');

        return back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back();
    }
}
