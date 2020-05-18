<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    protected $fillable = ['title','description','beginning_date','end_date','map_point','club_id','user_id'];

    public function club()
    {
        return $this->belongsTo(Club::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Зустріч, належить користувачам.
    */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_meet', 'meet_id', 'user_id');
    }
}
