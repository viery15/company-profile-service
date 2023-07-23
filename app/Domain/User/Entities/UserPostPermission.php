<?php

namespace App\Domain\User\Entities;

use Illuminate\Database\Eloquent\Model;

class UserPostPermission extends Model
{
    protected $table = 'user_post_permissions';

    protected $fillable = [
        'userId',
        'categoryId',
    ];
}
