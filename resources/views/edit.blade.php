@extends('layouts.app')

@section('stylesheet')
        <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="title">編集画面</h1>
    <div class="content col-md-6 offset-md-3">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
                <div class='content__title'>
                    <h2>タイトル</h2>
                    <input type='text' name='post[title]' value="{{ $post->title }}">
                </div>
                <div class='content__body'>
                    <h2>本文</h2>
                    <input type='text' name='post[body]' value="{{ $post->body }}">
                </div>
                @foreach ($tagList as $tag)
                <label class="checkbox">
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}" @if(in_array($tag->id,$tags)) checked @endif>
                    {{ $tag->name }}
                </label>
                @endforeach
            <input type="submit" value="保存">
        </form>
    </div>
    <div class="back col-md-1 offset-md-3">[<a href="/posts">戻る</a>]</div>
@endsection
