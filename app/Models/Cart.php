<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "carts";
    protected $fillable = [
        "user_id",
        "total_product"
    ];

    public function cartItem()
    {
        return $this->hasMany(CartItem::class, 'id');
    }
}
