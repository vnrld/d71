<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
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

    public ?Collection $categories = null;

    public array $selectedCategories = [];

    public function submit(string $contents = '', int $articleId = 0, array $categories = [])
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
            $this->article->save();
            $job = 'updated';
        } else {
            $this->article = Article::create($validatedData);
            $job = 'created';
        }

        if ($this->article instanceof Article) {
            $this->success = 'Article #' . $this->article->getId() . ' ' . $job . ' successfully!';

            ArticleCategory::where('article_id', '=', $this->article->getId())->delete();
            foreach ($categories as $category) {
                if ($category > 0) {
                    ArticleCategory::create(['article_id' => $this->article->getId(), 'category_id' => $category]);
                }
            }

        }
    }

    public function mount() {
        $this->articleId = (int)request()->segment(2);

        $this->categories = Category::all();
        $this->selectedCategories = [];

        if ($this->articleId > 0) {
            /**
             * @var Article $article
             */
            $this->article = Article::find($this->articleId);

            if ($this->article !== null) {

                $this->selectedCategories = $this->article->categories->pluck('id')->toArray();
                $this->title = $this->article->getTitle();
                $this->intro = $this->article->getIntro();
                $this->contents = $this->article->getContents();
                $this->publish_at = $this->article->getPublishAt();
            }

        }
    }

    public function render()
    {
        return view('livewire.article-form');
    }
}
