<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 
    ];

    public function users(){
        return $this->hasMany('App\User')->where('role_id', 3);
    }

    public function consultants(){
        return $this->hasMany('App\User')->where('role_id', 2);
    }
}
