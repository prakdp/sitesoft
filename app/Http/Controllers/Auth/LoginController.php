<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Контроллер авторизации / логаута
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Куда переправлять пользователя полсле успешной авторизации
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @inheritdoc
     */
    public function username()
    {
        return 'username';
    }

}
