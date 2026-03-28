<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // To be able to use create()
    use HasFactory;
    
    // Mass assignment and proctection
    protected $fillable = [
        'user_id',
        'title',
        'description'
    ];

    // Links project to a user
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Create relationship with task
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
