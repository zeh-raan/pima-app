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
        'title',
        'description'
    ];

    // Create relationship with task
    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
