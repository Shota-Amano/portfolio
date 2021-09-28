

@extends('layouts.app')
@section('stylesheet')
    
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    
@endsection

@section('create')

    
    <button id="create_btn"><a href="{{ route('create',['id'=> auth()->user()->id ]) }}">投稿する</a></button>
    
    
    <form class="form-inline my-2 my-lg-0 ml-2" action="/posts/search">
        <div class="form-group">
            <input type="search" class="form-control mr-sm-2" name="search"  value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
        </div>
        <input type="submit" value="検索" class="btn btn-info">
    </form>
    
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="desc col-md-8 offset-md-2">
            <p>この掲示板では、「こういうアプリがあったらいいな」などといった意見や、普段困っていることを募集しています。</p>
        </div>
    </div>
</div>

@foreach($searchTag as $searchTag)
<div class="posts container-fluid">
    
    <div class="row">
        
        <div class="post col-md-5 offset-md-1">
            <div class="post_frame">
                <a href="/posts/{{ $searchTag->id }}"></a>
                <p class="post_title">{{ $searchTag->title }}</p>
                <p class="post_body">{{ $searchTag->body }}</p>
            
            </div>
        </div>
        
        
        <div class="post col-md-5">
            <div class="post_frame">
                <p class="post_title">{{ $searchTag->title }}</p>
                <p class="post_body">{{ $searchTag->body }}</p>
            </div>
        </div>
        

    </div>
    
</div>
@endforeach
<div class="pagenate">
    
</div>
@endsection
