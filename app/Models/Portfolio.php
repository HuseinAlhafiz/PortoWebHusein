<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'category',
        'image',
        'link',
        'github_link',
        'features',
        'tech_stack',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'features' => 'array',
        'tech_stack' => 'array',
    ];
}
