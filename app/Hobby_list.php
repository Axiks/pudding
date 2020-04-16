<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby_list extends Model
{
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'hobby_list';

    /**
     * Определяет необходимость отметок времени для модели.
     */
    public $timestamps = false;

    public function hobby_group()
    {
        return $this->belongsTo(Hobby_group::class);
    }

    public function hobby_tags()
    {
        return $this->hasMany(Hobby_tag::class);
    }

    /**
     * Хобби, принадлежащие пользователям.
    */
    public function captivate()
    {
        return $this->belongsToMany('App\User', 'user_hobby', 'hobby_list_id', 'user_id');
    }
}
