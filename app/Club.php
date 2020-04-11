<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Club extends Model
{
    protected $fillable = ['name','description','cover_src','avatar_src','creator_id'];
    protected $attributes = array(
        'avatar_src' => 'default/default-avatar.jpg'
    );

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function meets()
    {
        return $this->hasMany(Meet::class);
    }

    public function choto(){
        return ("Test string");
    }
}
