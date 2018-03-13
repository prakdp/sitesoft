@extends('layouts.app')

@section('content')
<div class="row-fluid">
    <div class="span4"></div>
    <div class="span3">

        @if ($errors->any())
            <div class="alert alert-error">
                Вход в систему с указанными данными невозможен
            </div>
        @endif

        <form action="{{ route('login') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="control-group">
                <b>Авторизация</b>
            </div>
            <div class="control-group">
                <input type="text" id="inputLogin" name="username" value="{{ old('username') }}" placeholder="Логин" data-cip-id="inputLogin" autocomplete="off">
            </div>
            <div class="control-group">
                <input type="password" id="inputPassword" name="password" placeholder="Пароль" data-cip-id="inputPassword">
            </div>
            <div class="control-group">
                <label class="checkbox">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                </label>
                <button type="submit" class="btn btn-primary">Вход</button>
            </div>
        </form>
    </div>
</div>
@endsection
