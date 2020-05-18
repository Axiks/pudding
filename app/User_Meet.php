<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Meet extends Model
{
    protected $fillable = ['user_id', 'meet_id'];
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'user_meet';

    /**
     * Определяет необходимость отметок времени для модели.
     */
    public $timestamps = true;
}
