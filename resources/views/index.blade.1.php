<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--scripts-->
        <script src="{{ asset('js/app.js') }}" defer></script>
        
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/index.css') }}" rel="stylesheet">
        
    </head>
    <body>
         <div>
            <h3 class="title">タイトル</h3>
        </div>
        
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
                        <p class="post_title">{{ $post->title }}</p>
                        <p class="post_body">本文</p>
                    </div>
                </div>
                
                <div class="post col-md-5">
                    <div class="post_frame">
                        <p class="post_title">{{ $post->title }}</p>
                        <p class="post_body">本文</p>
                    </div>
                </div>
                
        @endforeach
            </div>
            
        </div>
        
    </body>
</html>
