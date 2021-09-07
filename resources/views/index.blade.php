@extends('layouts.app')
@section('content')
<style>
    .title{
        border-bottom: double;
        padding: 0.5rem;
    }

    .desc{
        text-align: center;
        border:solid;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    
    .post_frame{
        margin:1rem;
        border:solid;
    }
    
    .post_frame a{
        position: absolute;
        top: 0;
        left: 0;
        height:100%;
        width: 100%;
    }
    
    .post_frame a:hover{
        opacity: 0.1;
        background-color: #000000;
    }
    
    .post_title{
        border-bottom: solid;
        padding: 0.5rem;
    }
    
    .post_body{
        padding: 0.5rem;
    }
    
    .create_btn{
        position: fixed;
        bottom: 2rem; 
        right: 2rem;
        padding: 0.5rem 0.5rem;
    }
    
    .pagenate{
        background-color: red;
        margin: auto;
        }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="desc col-md-8 offset-md-2">
            <p>この掲示板では、「こういうアプリがあったらいいな」などといった意見や、普段困っていることを募集しています。</p>
        </div>
    </div>
</div>


@foreach($posts as $post)
<div class="posts container-fluid">
    
    <div class="row">
        
        <div class="post col-md-5 offset-md-1">
            <div class="post_frame">
                <a href="/posts/{{ $post->id }}"></a>
                <p class="post_title">{{ $post->title }}</p>
                <p class="post_body">{{ $post->body }}</p>
            
            </div>
        </div>
        
        
        <div class="post col-md-5">
            <div class="post_frame">
                <p class="post_title">{{ $post->title }}</p>
                <p class="post_body">本文</p>
            </div>
        </div>
        

    </div>
    
</div>
@endforeach
<div class="pagenate">
    {{ $posts->links() }}
</div>
<button id="create_btn"><a href="{{ route('create',['id' => auth()->user()->id ]) }}">＋</a></button>
@endsection
