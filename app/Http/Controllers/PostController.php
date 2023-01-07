<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Post;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * View all posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $posts = Community::paginate(4);
        return view('post.view-all', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communities = Community::all();
        return view('post.create', ['communities' => $communities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'community_id' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);
        $slug = $request->title;
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
        $slug = trim($slug, '-');
        $slug = preg_replace('~-+~', '-', $slug);
        $slug = strtolower($slug);
        
        $post = new Post;
        
        $image_name = $slug.'.'.$request->image->extension();
        $request->image->move(public_path('images'), $image_name);
        $post->file_path = $image_name;
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->user_id = $validatedData['user_id'];
        $post->community_id = $validatedData['community_id'];
        $post->slug = $slug;
        $post->save();

        session()->flash('message', 'New post created!');
        return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
