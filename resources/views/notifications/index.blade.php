@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notificationes</h1>
    <div class="row">
        <div class="col-sm-6">
            <h2>No leídas</h2>
            <ul class="list-group">
                @foreach ($unreadNotifications as $notification)
                    <li class="list-group-item">
                        <a href="{{ $notification->data['link'] }}">{{ $notification->data['text'] }}</a>
                        <form method="POST" action=" {{ route('notifications.read', $notification->id) }}" class="pull-right">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-xs">X</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-6">
            <h2>Leídas</h2>
            <ul class="list-group">
                @foreach ($readNotifications as $notification)
                    <li class="list-group-item">
                        <a href="{{ $notification->data['link'] }}">{{ $notification->data['text'] }}</a>
                        <form method="POST" action=" {{ route('notifications.destroy', $notification->id) }}" class="pull-right">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-xs">X</button>
                        </form>
                    </li>
                @endforeach
            </ul>            
        </div>
    </div>
</div>
@endsection