<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function orderStatus() {
        return $this->belongsTo(Order_status::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function orderItems() {
        return $this->hasMany(Order_item::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'order_users');
    }

    public function orderUsers() {
        return $this->hasMany(Order_user::class);
    }

    public function buyer() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
