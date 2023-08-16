<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Models\Post;




class PostController extends Controller
{
    public function index(Post $post)
    {
        // $test = $post->orderBy('updated_at', 'DESC')->limit(2)->toSql(); //確認用に追加
    //dd($test); 
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    public function show(Post $post)
    {
        
        //dd($post);
        return view('posts.show')->with(['post' => $post]);
     //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
    }
    public function create()
    {
    return view('posts.create');
    }
    public function store(PostRequest $request,Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
          //上と同じ意味になる書き方->$post->create($input);
        return redirect('/posts/'. $post->id);
        //dd($request->all());
    }
    public function edit(Post $post)
    {
    return view('posts.edit')->with(['post' => $post]);
    }
    public function update(PostRequest $request, Post $post)
    {
        $input_post =$request['post'];
        $post->fill($input_post)->save();
        //return redirect('/');
        //return redirect('/posts' . $post->id);
        return redirect('/posts/' . $post->id);
    }
}
