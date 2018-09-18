<?php

namespace App;

use App\Feature;

use App\Review;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function features() {
        return $this->belongsToMany(Feature::class);
    }

}
