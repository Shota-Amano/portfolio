<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        
        
        return view('index')->with(['posts' => $post->getPaginateByLimit(10)]);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('create')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, $id, Post $post, Tag $tag)
    {
        
        $tags = [];
            
        array_push($tags, $request->tags);
        
        
        dd($tags);
        
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };
        
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        
        
       
        
        $post->tags()->attach($tags_id);
        
        return redirect('/posts')->with('success', '新規登録完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $id)
    {
        $tag = Tag::find($id);
        $post = Post::find($id);
        
        $postTag = $post->find($id)->tags()->pluck('name');
        
        
        return view('show')->with([
            'post'=>$post,
            'tag'=>$tag,
            'postTag'=>$postTag
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $post = Post::find($post->id);
        $tags = $post->tags->pluck('id')->toArray();
        $tagList = Tag::all();
        return view('edit', compact('post', 'tags', 'tagList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $update = [
            'title' => $request->title,
        ];
        Post::where('id', $id)->update($update);
        $post = Post::find($id);
        $post->tags()->sync(request()->tags);
        return view('show')->with('success', '編集完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post, $id)
    {
        
        $post = Post::find($post->id);
        $item =DB::select('select * from posts where id = :id',$post);
        
        return view('show',['post' => $item[0]]);
    }
    
    public function remove(Request $request, Post $post){
        $param = ['id' => $post->id];
        
        DB::delete('delete from posts where id = :id', $param);
        return redirect('/posts');
    }
    
    
    public function searchPost(Post $post, Request $request){
        
        $searchtag = $request->search;
        $searchTag = Post::where('title', '=', $searchtag)->get();
        // $tag = Post::find($id)->tags;
        
        $post = Post::all();
        
        return view('search')->with([
            'post'=>$post,
            'searchTag'=>$searchTag
        ]);
    }
}
