<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'price', 'condition', 
        'description', 'image', 'seller_name', 'seller_contact', 'is_sold'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeExpired($query)
    {
        return $query->where('created_at', '<', now()->subDays(20));
    }

    public static function deleteExpired()
    {
        $expiredProducts = self::where('created_at', '<', now()->subDays(20))->get();
        
        foreach ($expiredProducts as $product) {
            if ($product->image && file_exists(public_path('images/' . $product->image))) {
                unlink(public_path('images/' . $product->image));
            }
            $product->delete();
        }
        
        return $expiredProducts->count();
    }
}