<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * Class Article
 * @package App\Models
 *
 * @method string getTitle()
 * @method string getSlug()
 * @method string getIntro()
 * @method string getContents()
 * @method string getPublishAt()
 */
class Article extends GenericModel
{
    protected $fillable = [
        'title',
        'slug',
        'intro',
        'contents',
        'publish_at'
    ];

    public $with = ['categories'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'articles_categories', 'article_id', 'category_id');
    }

    public function getHtml(): string
    {
        $parser = new \Parsedown();
        return $parser->text($this->getContents());
    }

}
