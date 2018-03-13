<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Контроллер регистрации пользователя
 */
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Куда переправлять пользователя полсле успешной регистрации
     *
     * @var string
     */
    protected $redirectTo = '/register/success';

    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Правила валидации
     *
     * @param  array  $data Данные
     * @return \Illuminate\Contracts\Validation\Validator Валидатор
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:6|max:32|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Создание нового пользователя после валидации
     *
     * @param  array  $data Данные
     * @return \App\User Сущность пользователя
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
    }

    /**
     * Отобразить страницу успешной регистрации
     *
     * @return \Illuminate\Http\Response
     */
    public function success()
    {
        return view('auth.register-success');
    }
}
