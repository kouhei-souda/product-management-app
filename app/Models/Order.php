<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'postal_code',
        'prefecture',
        'city',
        'address',
        'building',
        'total_price',
    ];
}
