<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'status',
        'is_hot_today',
    ];

    protected $casts = [
        'is_hot_today' => 'boolean',
    ];
}
