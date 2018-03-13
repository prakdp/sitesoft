<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'message'
    ];

    /**
     * Атрибуты, которые не будут преобразованы в массив.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    /**
    * Атрибуты, которые должны быть преобразованы в даты.
    *
    * @var array
    */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Получить запись пользователя.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
