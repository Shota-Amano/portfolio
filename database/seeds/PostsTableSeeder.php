<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     
    
    public function run()
    {
        $tags = Tag::all();
        
        factory(Post::class,15)->create()
        ->each(function (App\Post $post) use ($tags) {
                //1~6までの数値をランダムで取得
                $ran = rand(1, 6);
                
                // 中間テーブルに紐付け
                $post->tags()->attach(
                    //tagsテーブルからランダムで1~6個のインスタンスを紐づける。
                    $tags->random($ran)->pluck('id')->toArray(),
                );
            });;
    }
}
