<?php

namespace App\Domain\File\Entities;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $fillable = ['path'];
}
