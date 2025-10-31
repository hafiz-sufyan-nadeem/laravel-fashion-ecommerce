<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'city',
        'state',
        'zip',
        'payment_method',
        'transaction_id',
        'total_amount',
        'status'
    ];

    public function orderItems()
    {
        return $this->hasMany('App\Models\OrderItem');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
