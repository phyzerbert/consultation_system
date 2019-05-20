<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id', 'consultant_id', 'category_id','subject', 'description', 'phone', 'file_path',
    ];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function consultant(){
        return $this->belongsTo('App\User', 'consultant_id');
    }
}
