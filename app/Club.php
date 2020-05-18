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

    /**
     * Clubs, принадлежащие пользователю.
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_club', 'club_id', 'user_id');
    }

    /**
     * Хобби, принадлежащие клубу.
    */
    public function clubs()
    {
        return $this->belongsToMany('App\Hobby_list', 'club_hobby', 'club_id', 'hobby_id');
    }

    /**
     * Клуб, принадлежащие хобби.
    */
    public function hobbyes()
    {
        return $this->belongsToMany('App\Hobby_list', 'club_hobby', 'club_id', 'hobby_id');
    }
}
