<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['category_ids', 'code', 'description'];

    protected $casts = [
        'category_ids' => 'array',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories', 'id', 'id');
    }
}
