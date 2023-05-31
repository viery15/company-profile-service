<?php

namespace App\Domain\Post\Entities;

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
    ];
}
