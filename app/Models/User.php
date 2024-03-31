<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{

    public const ROLE_USER = 'user';
    public const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'role',
    ];
}
