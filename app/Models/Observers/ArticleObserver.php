<?php

declare(strict_types=1);

namespace App\Models\Observers;

use App\Models\Article;
use Illuminate\Support\Str;

class ArticleObserver
{
    public function creating(Article $article): void
    {
        $article->setAttribute('slug', Str::slug($article->getTitle()));
    }

    public function deleted(Article $model): void
    {
        $model->trixRichText->each->delete();
        $model->trixAttachments->each->purge();
    }
}
