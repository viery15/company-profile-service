<?php

namespace App\Domain\Configuration\Entities;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';

    protected $fillable = [
        'key',
        'value'
    ];
}
