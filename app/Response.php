<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'question_id', 'user_id', 'response_text','ip_address',
    ];
    
    public function question(){
        return $this->hasMany('App\Question');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function attachment(){
        return $this->hasOne('App\Attachment', 'parent_id')->where('type', 2);
    }
}
