<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club_Hobby extends Model
{
    protected $fillable = ['club_id', 'hobby_id'];
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'club_hobby';

    /**
     * Определяет необходимость отметок времени для модели.
     */
    public $timestamps = true;
}
