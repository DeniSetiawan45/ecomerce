<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'type', 'icon', 'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }
}