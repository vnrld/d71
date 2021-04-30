<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function getArticle(int $articleId): View
    {
        return view('articles/articles-create');
    }

    public function previewArticle(int $articleId) {
        return view('articles/articles-preview')->with(['article' => Article::find($articleId)]);
    }

    public function getArticles(int $offset = 1): View
    {
        $limit = 5;

        $articles = Article::orderBy('id', 'desc')->limit($limit)->get();

        $arr = [];
        $arr['first'] = [];
        $arr['posts'] = [];

        foreach ($articles as $index => $article) {
            if ($index === 0) {
                $arr['first'] = $article;
            } else {
                $arr['posts'][] = $article;
            }
        }

        $arr['posts'] = array_chunk($arr['posts'], 2);

        return view('welcome')->with(['articles' => $arr]);
    }

    public function getArticleBySlug(string $slug)
    {
       $article = Article::where('slug', '=', $slug)->first();
       if ($article === null) {
           return redirect('/');
       }

        ViewFacade::share(['pageTitle' => $article->getTitle()]);

       return view('articles.article-page')->with(['article' => $article]);

    }

    public function listArticles(): View
    {
        return \view('articles.articles-list')->with(['articles' => Article::all()]);
    }
}
