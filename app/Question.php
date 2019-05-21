<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id', 'consultant_id', 'category_id','subject', 'description', 'phone',
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

    public function responses(){
        return $this->hasMany('App\Response', 'question_id');
    }

    public function attachment(){
        return $this->hasOne('App\Attachment', 'parent_id')->where('type', 1);
    }
}
