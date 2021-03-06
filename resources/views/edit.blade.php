@extends('layouts.app')

@section('stylesheet')
        <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="post col-md-6 offset-md-3">
                <div class="post_title">
                    <form action="{{ route('update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                            <div class='content__title'>
                                <h5>タイトル</h5>
                                <input type='text' name='post[title]' value="{{ $post->title }}">
                            </div>
                            <div class='content__body'>
                                <h5>本文</h5>
                                <input type='text' name='post[body]' value="{{ $post->body }}">
                            </div>
                            @foreach ($tagList as $tag)
                            <label class="checkbox">
                                <input type="checkbox" name="tags[]" value="{{$tag->id}}" @if(in_array($tag->id,$tags)) checked @endif>
                                {{ $tag->name }}
                            </label>
                            @endforeach
                        <button type="submit" value="保存">
                    </form>
                    
                </div>
                
                
            </div>
        </div>
    </div>
    <div class="fooder container-fluid">
        <div class="row">
            <div class="back col-md-1 offset-md-3">[<a href="/posts">戻る</a>]</div>
        </div>
    </div>
@endsection
