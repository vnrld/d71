<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Class Article
 * @package App\Models
 *
 * @method string getName()
 */
class ArticleCategory extends GenericModel
{
    protected $table = 'articles_categories';

    protected $fillable = [
        'name'
    ];
}
