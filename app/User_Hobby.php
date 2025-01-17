<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Hobby extends Model
{
    protected $fillable = ['user_id', 'hobby_id'];
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'user_hobby';

    /**
     * Определяет необходимость отметок времени для модели.
     */
    public $timestamps = true;
}
