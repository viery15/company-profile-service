<?php

namespace App\Domain\Catalog\Entities;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $table = 'catalogs';

    protected $fillable = [
        'path',
        'description',
        'postId',
        'updatedBy'
    ];
}
