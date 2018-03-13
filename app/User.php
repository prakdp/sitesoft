<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable, SoftDeletes;

    /**
     * Атрибуты, для которых разрешено массовое назначение.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password'
    ];

    /**
     * Атрибуты, которые не будут преобразованы в массив.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
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
     * Получить запись с сообщениями пользователя.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
