@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach (App\Post::latest()->get() as $post)
                <div class="panel panel-default">
                    <div class="panel-heading"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></div>
                </div>
            @endforeach                
        </div>
    </div>
</div>
@stop