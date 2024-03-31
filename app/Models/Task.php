<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{

    protected $fillable = [
        'title',
        'description',
        'assigned_to_id',
        'created_by_id',
    ];

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'role' => User::ROLE_USER,
        ]);
    }


    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'role' => User::ROLE_ADMIN,
        ]);
    }


    
}
