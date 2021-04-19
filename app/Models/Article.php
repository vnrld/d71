<?php

declare(strict_types=1);

namespace App\Models;

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


}
