<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'slug', 'description', 'price', 'stock', 'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return '/img/default/product.png';
        }

        return '/storage/products/' . $this->image;
    }

    public function getShortDescriptionAttribute()
    {
        return Str::words(strip_tags($this->description), 20, '...');
    }
}
