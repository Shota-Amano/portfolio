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
        //$postTag = $post->find($post->id)->tags()->plunk('name');
        //dd($postTag);
        
        return view('index')->with(['posts' => $post->getPaginateByLimit()]);
        
        
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
        
        $post = new Post;
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        
        $tag = new Tag;
        $tag->name = $request->tags;
        
        $post->tags()->attach($request->tags);
        
        return redirect()->route('index')->with('success', '新規登録完了しました');
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
    public function edit(Post $post, $id)
    {
        $post = Post::find($id);
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
        return back()->with('success', '編集完了しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Post $post, $id)
    {
        
        $post = Post::find($id);
        $post->delete();
        $post->tags()->detach();
        return redirect()->route('index')->with('success', '削除完了しました');
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
