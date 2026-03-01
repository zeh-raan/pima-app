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
        'project_id',
        'title',
        'status',
        'due_date'
    ];
    // Create relationship with project
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
