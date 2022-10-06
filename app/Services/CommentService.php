<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentService
{
    public function save(Request $request, int $id): RedirectResponse
    {
        $comment = new Comment([
            'article_id' => $id,
            'nickname' => $request->nickname,
            'content' => $request->comment,
        ]);
        $comment->save();
        return Redirect::back();
    }

    public function updateComment(Request $request, int $id): RedirectResponse
    {
        $comment = Comment::where('id', $id)->first();
        $comment->nickname = $request->nickname;
        $comment->content = $request->comment;
        $comment->updated_at = now();

        $comment->save();

        return Redirect::back();

    }

    public function deleteComment(Request $request): RedirectResponse
    {
        Comment::where('id', $request->id)->delete();

        return Redirect::back();
    }
}
