<?php

namespace App;

use App\User_type;

use App\Review;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password'
    // ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    // public function user_type(){
    //     return $this->belongsTo(User_type::class);
    // }
    public function user_type(){
        return $this->belongsTo(User_type::class);
    }

    public function isAdmin(){
        return ($this->user_type()->get() == 1)?true:false;
    }
    public function features() {
        return $this->hasMany(Feature::class);
    }
    public function products() {
        return $this->hasMany(Product::class);
    }
    public function orders() {
        return $this->hasMany(Order::class);
    }
    public function placedOrders() {
        return $this->belongsToMany(Order::class, 'order_users');
    }
}
