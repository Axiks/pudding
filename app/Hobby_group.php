<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby_group extends Model
{
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'hobby_group';

    /**
     * Определяет необходимость отметок времени для модели.
     */
    public $timestamps = false;

    public function hobby_list()
    {
        return $this->hasMany(Hobby_list::class);
    }
}
