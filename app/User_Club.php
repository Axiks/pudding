<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Club extends Model
{
    protected $fillable = ['user_id', 'club_id'];
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'user_club';

    /**
     * Определяет необходимость отметок времени для модели.
     */
    public $timestamps = true;
}
