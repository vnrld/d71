<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function getArticle(int $articleId): View
    {
        return view('articles/articles-create');
    }

    public function getArticleBySlug(string $slug)
    {
        try {
            return view('frontend.article')->with(['article' => Article::where('slug', '=', $slug)->firstOfFail()]);
        } catch (\Exception $exception) {
            return redirect('/');
        }
    }
}