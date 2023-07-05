<?php

namespace App\Domain\Category\Entities;

use App\Domain\Post\Entities\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'seq',
        'pinToMenu',
        'showPosts'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'categoryId');
    }
}
