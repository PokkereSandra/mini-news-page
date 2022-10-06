<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticleService
{
    public function showAll(): Collection
    {
        return Article::all()->sortByDesc('created_at');
    }

    public function sortByComments(): Collection|array
    {
        return Article::with('comments')->get()->sortByDesc(function ($article) {
            return $article->comments->count();
        });
    }

    public function articleById(int $id)
    {
        return Article::where('id', $id)->first();
    }

    public function addArticle(Request $request): RedirectResponse
    {
        $article = new Article([
            'user_id' => Auth::user()->getAuthIdentifier(),
            'title' => $request->title,
            'content' => $request->article]);
        if ($request->file('image') == null) {
            $article->image = null;
        } else {
            $article->image = $request->file('image')->store('images', ['disk' => 'public']);
        }
        $article->save();
        return Redirect::route('home');
    }

    public function updateArticle(Request $request, int $id): RedirectResponse
    {
        $article = Article::where('id', $id)->first();
        $article->title = $request->title;
        $article->content = $request->articleContent;
        if ($request->file('image') == null) {
            $article->image = '';
        } else {
            $article->image = $request->file('image')->store('images', ['disk' => 'public']);
        }
        $article->updated_at = now();
        $article->save();

        return Redirect::back();

    }

    public function deleteArticle(Request $request): RedirectResponse
    {
        Article::where('id', $request->id)->delete();
        Comment::where('article_id', $request->id)->delete();

        return Redirect::route('home');
    }

}


