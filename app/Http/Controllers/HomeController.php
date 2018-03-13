<?php

namespace App\Http\Controllers;

use App\Message;

/**
 * Контроллер главной страницы
 */
class HomeController extends Controller
{
    /**
     * Главная страница
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('user')->orderBy('created_at', 'desc')->get();

        return view('home', ['messages' => $messages]);
    }
}
