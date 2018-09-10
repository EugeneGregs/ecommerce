<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class User_type extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class);
    }
}
