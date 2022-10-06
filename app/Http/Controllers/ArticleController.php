<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use App\Services\CommentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ArticleController extends Controller
{
    public function home(): Factory|View|Application
    {
        $articles = (new ArticleService())->showAll();
        return view('home', [
            'articles' => $articles,
        ]);
    }

    public function mostCommented(): Factory|View|Application
    {
        $articles = (new ArticleService())->sortByComments();
        return view('home', [
            'articles' => $articles,
        ]);
    }

    public function show(int $id): Factory|View|Application
    {
        $article = (new ArticleService())->articleById($id);

        return view('article', [
            'article' => $article,
        ]);
    }

    public function addComment(Request $request, int $id): RedirectResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nickname' => 'required',
                'comment' => 'required',
                'captcha' => 'required|captcha'

            ],
            ['captcha.captcha' => 'Enter valid captcha code shown in image']
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        } else {
            return (new CommentService)->save($request, $id);
        }
    }

    public function reloadCaptcha(): string
    {
        return captcha_img();
    }

    public function showForm(): Factory|View|Application
    {
        return view('add-article');
    }

    public function addArticle(Request $request): RedirectResponse
    {
        return (new ArticleService())->addArticle($request);
    }

    public function editArticle(Request $request, int $id): RedirectResponse
    {
        return (new ArticleService())->updateArticle($request, $id);
    }

    public function destroyArticle(Request $request): RedirectResponse
    {
        return (new ArticleService())->deleteArticle($request);
    }

    public function editComment(Request $request, int $id): RedirectResponse
    {
        return (new CommentService())->updateComment($request, $id);
    }

    public function destroyComment(Request $request): RedirectResponse
    {
        return (new CommentService())->deleteComment($request);
    }
}
