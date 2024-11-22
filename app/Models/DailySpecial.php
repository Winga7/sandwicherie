<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySpecial extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'image_path',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];
}
