@extends('layouts.app')

@section('content')
<div class="row-fluid">
    <div class="span2"></div>
    <div class="span8">

        @auth
        <form action="{{ route('messages') }}" method="post" class="form-horizontal" style="margin-bottom: 50px;">
            {{ csrf_field() }}
            @if ($errors->has('message'))
            <div class="alert alert-error">
                {{ $errors->first('message') }}
            </div>
            @endif
            <div class="control-group">
                <textarea name="message" style="width: 100%; height: 50px;" id="messageText" placeholder="Ваше сообщение..." data-cip-id="messageText">{{ old('message') }}</textarea>
            </div>
            <div class="control-group">
                <button type="submit" class="btn btn-primary">Отправить сообщение</button>
            </div>
        </form>
        @endauth

        @if (count($messages))
            @foreach ($messages as $message)
                <div class="well">
                    <h5>{{ $message->user->username }}</h5>
                    {!! nl2br($message->message) !!}
                </div>
            @endforeach
        @else
        <div class="alert alert-info">
            Стена сообщений пуста :(
        </div>
        @endif
    </div>
</div>

@endsection
