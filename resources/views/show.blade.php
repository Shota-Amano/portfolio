@extends('layouts.app')
@section('stylesheet')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endsection

@section('content')
    <body>
        
        
        <button class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></button>
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" style="display:inline" onclick="check">
            @csrf
            @method('DELETE')
            <button type="submit">delete</button> 
        </form>
        
        <div class="container-fluid">
            <div class="row">
                <div class="post col-md-6 offset-md-3">
                    <div class="post_title">
                        <h5>タイトル</h5>
                        <p>{{ $post->title }}</p>
                    </div>
                    <div class="post_body">
                        <h5>本文</h5>
                        <p>{{ $post->body }}</p>
                        
                    </div>
                    <div class="post_update">
                        <h5>最終更新日時</h5>
                        <p>{{ $post->updated_at }}</p>
                    </div>
                    
                    <div class="post_tag">
                        <h5>タグ</h5>
                        <p>{{ $postTag }}</p>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <div class="fooder container-fluid">
            <div class="row">
            
                <div class="back col-md-1 offset-md-3">[<a href="/posts">戻る</a>]</div>
            </div>
        </div>
    </body>
@endsection
