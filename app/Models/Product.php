<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'stock', 'user_id'];

    public function scopeSearch($query, $keyword)
    {
        if (!$keyword) {
            return $query;
        }

        return $query->where('name', 'like', "%{$keyword}%")->orWhere('description', 'like', "%{$keyword}%");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
