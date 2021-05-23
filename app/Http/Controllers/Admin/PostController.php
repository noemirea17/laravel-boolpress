<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'tags' => Tag::all()
        ];
        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50',
            'text' => 'required',
        ]);

        $form_data = $request->all();

        $new_post = new Post();
        $new_post->fill($form_data);

        $slug = Str::slug($new_post->title);
        $slug_base = $slug;

        $post_presente = Post::where('slug', $slug)->first();
        $contatore = 1;

        while($post_presente) {
            $slug = $slug_base.'-'.$contatore;
            $contatore++;
            $post_presente = Post::where('slug', $slug)->first();
        }

        $new_post->slug = $slug;

        $new_post->user_id = Auth::id();
        $new_post->save();

        if(array_key_exists('tags', $form_data)){
            $new_post->tags()->sync($form_data['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id) {
            $post = Post::find($id);

            $data = [
                'post' => $post
            ];
            
        }
        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = [
            'tags' => Tag::all()
        ];
        return view('admin.posts.edit', compact('post'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }
        else {
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.index', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
