<?php

namespace App\Domain\Post\Entities;

use App\Domain\Category\Entities\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'categoryId',
        'content',
        'path',
        'thumbnail',
        'createdBy',
        'updatedBy',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'categoryId');
    }
}
