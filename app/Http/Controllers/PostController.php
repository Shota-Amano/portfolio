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
        
        
        $tags_id = [];
        if(($request->tagSelf)!=null){
            //重複する内容がなければ新たにレコードの作成
            $record = Tag::firstOrCreate(['name' => $request->tagSelf]);
            array_push($tags_id, $record->id);    
        }
        
        if(($request->tags) != null){
            
            foreach($request->tags as $tags) {
                array_push($tags_id, $tags);
                
            }
        }
        
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        
        
        if($tags_id != null){
            $post->tags()->attach($tags_id);
        }
        
       
        return redirect()->route('index');
        
        
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
        
        return view('edit')->with([
            'post'=>$post,
            'tags'=>$tags,
            'tagList'=>$tagList
            ]);
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
        /*$update = [
            'title' => $request->title,
        ];
        Post::where('id', $id)->update($update);
        $post = Post::find($id);
        $post->tags()->sync(request()->tags);*/
        dd($post); 
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        
        return redirect('/posts/' . $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del(Post $post, $id)
    {
        $post = Post::find($id);
        return redirect('/posts') ->with([
            'post' => $post
            ]);
    }
    
    
    public function remove(Request $request, Post $post){
        Post::find($request->id)->delete();
        return redirect('/posts') ->with([
            'post' => $post
            ]);
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
