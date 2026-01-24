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
        'image',
    ];

    protected $casts = [
        'is_hot_today' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random&size=128';
    }
}
