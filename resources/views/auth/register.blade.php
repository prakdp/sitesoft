@extends('layouts.app')

@section('content')
<div class="row-fluid">
    <div class="span4"></div>
    <div class="span8">

        <form action="{{ route('register') }}" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="control-group">
                <b>Регистрация</b>
            </div>
            <div class="control-group{{ $errors->has('username') ? ' error' : '' }}">
                <input type="text" id="inputLogin" name="username" placeholder="Логин" value="{{ old('username') }}" data-cip-id="inputLogin" autocomplete="off">
                @if ($errors->has('username'))
                    <span class="help-inline">
                        {{ $errors->first('username') }}
                    </span>
                @endif
            </div>
            <div class="control-group{{ $errors->has('password') ? ' error' : '' }}">
                <input type="password" id="inputPassword" name="password" placeholder="Пароль" data-cip-id="inputPassword">
                @if ($errors->has('password'))
                    <span class="help-inline">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
            <div class="control-group">
                <input type="password" id="inputPasswordconfirmation" name="password_confirmation" placeholder="Повторите пароль" data-cip-id="inputPasswordconfirmation">
            </div>
            <div class="control-group">
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </form>
    </div>
</div>
@endsection
