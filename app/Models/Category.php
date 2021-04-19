<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Support\Facades\Log;

/**
 * Class Article
 * @package App\Models
 *
 * @method string getName()
 */
class Category extends GenericModel
{
    protected $fillable = [
        'name'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
