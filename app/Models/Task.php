<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // To be able to use create()
    use HasFactory;

    // Mass assignment and protection
    protected $fillable = [
        'user_id',
        'project_id',
        'title',
        'status',
        'due_date'
    ];

    // Links to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Create relationship with project
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // TODO: Add a method to renew a missed task
}
