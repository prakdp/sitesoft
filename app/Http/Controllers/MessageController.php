<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер сообщений
 */
class MessageController extends Controller
{
    /**
     * Конструктор
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Создание нового сообщения
     *
     * @param  Request $request
     * @return Message Сущность сообщения
     */
    public function post(MessageRequest $request)
    {
        $message = new Message();
        $message->fill($request->all());
        $user = Auth::user();
        $user->messages()->save($message);
        return redirect('/');
    }
}
