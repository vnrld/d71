<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleForm extends Component
{

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->publish_at = (new \DateTime('now'))->format(DATE_W3C);
    }

    private ?Article $article = null;

    public int $articleId = 0;

    public string $success = '';

    public string $title = '';

    public string $intro = '';

    public string $contents = '';

    public string $publish_at = '';

    public function submit(string $contents = '', int $articleId = 0)
    {
        $validatedData = $this->validate(
            [
                'title' => 'required|min:1',
                'intro' => 'nullable|string',
                'contents' => 'nullable|string',
                'publish_at' => 'nullable'
            ]
        );

        $validatedData['contents'] = $contents;

        if (empty($validatedData['publish_at'])) {
            $validatedData['publish_at'] = $this->publish_at;
        }

        if ($articleId > 0) {
            $this->article = Article::find($articleId);
            $this->article->fill($validatedData);
            $this->save();
            $job = 'updated';
        } else {
            $article = Article::create($validatedData);
            $job = 'created';

        }

        if ($article instanceof Article) {
            $this->success = 'Article #' . $article->getId() . ' ' . $job . ' successfully!';
        }
    }

    public function mount() {
        $this->articleId = (int)request()->segment(2);

        var_dump($this->articleId);

        if ($this->articleId > 0) {
            /**
             * @var Article $article
             */
            $this->article = Article::find($this->articleId);

            $this->title = $this->article->getTitle();
            $this->intro = $this->article->getIntro();
            $this->contents = $this->article->getContents();
            $this->publish_at = $this->article->getPublishAt();

        }
    }

    public function render()
    {
        return view('livewire.article-form');
    }
}
