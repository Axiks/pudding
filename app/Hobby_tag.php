<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby_tag extends Model
{
    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'hobby_tag';

    public function hobby_list()
    {
        return $this->belongsTo(Hobby_list::class);
    }
}
