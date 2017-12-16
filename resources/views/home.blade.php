@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Enviar mensaje</div>

                <form method="POST" action=" {{ route('messages.store') }}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="form-group {{ $errors->has('recipient_id') ? 'has-error' : '' }}">
                            {!! $errors->first('recipient_id', "<span class=help-block>:message</span>") !!}
                            <select name="recipient_id" class="form-control">
                                <option value="">Selecciona el usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            {!! $errors->first('body', "<span class=help-block>:message</span>") !!}
                            <textarea name="body" class="form-control" placeholder="Escribe tu mensaje"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
