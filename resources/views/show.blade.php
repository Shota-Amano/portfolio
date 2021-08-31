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
        <link href="{{ asset('css/show.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div>
            <h3 class="title">タイトル</h3>
        </div>
        
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
                </div>
            </div>
        </div>
        
        <div class="back">[<a href="/posts">戻る</a>]</div>
    </body>
</html>
