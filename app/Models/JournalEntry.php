<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'skill_id',
        'goal_id',
        'type',
        'content',
        'date',
        'completed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSkills($query, $userId)
    {
        return $query->where('user_id', $userId)->where('type', 'skill');
    }

    public function scopeGoals($query, $userId)
    {
        return $query->where('user_id', $userId)->where('type', 'goal');
    }

    public function scopeTodos($query, $userId)
    {
        return $query->where('user_id', $userId)->where('type', 'todo');
    }
}
