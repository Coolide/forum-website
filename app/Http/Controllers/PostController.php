<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Community;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Notification;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $creator = User::findOrFail($post->user_id);
        $community = Community::findOrFail($post->community_id);
        $votes = Vote::all();
        return view('post.view', ['post' => $post, 'creator' => $creator, 'community' => $community, 'votes' => $votes]);
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
        $user = User::findOrFail($validatedData['user_id']);
        $post->username = $user->username;
        $post->save();

        session()->flash('message', 'New post created!');
        return redirect()->route('home');
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
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $communities = Community::all();

        return view('post.edit', ['post'=>$post, 'communities'=>$communities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $post->description = $request->description;
        $post->title = $request->title;
        $post->update();

        if($post->user_id != $request->user_id){
            Notification::firstOrCreate(['description' => "Your recent post has been edited.", 'user_id' => $post->user_id]);
        }

        $creator = User::findOrFail($post->user_id);
        $community = Community::findOrFail($post->community_id);
        $votes = Vote::all();
        session()->flash('message', 'Post edited!');
        return view('post.view', ['post' => $post, 'creator' => $creator, 'community' => $community, 'votes' => $votes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $community = Community::findOrFail($post->community_id);
        if($post->user_id != $request->user_id){
            Notification::firstOrCreate(['description' => "Your recent post has been deleted.", 'user_id' => $post->user_id]);
        }
        $post->delete();

        return redirect()->route('show.community', ['slug'=>$community->slug]);
    }
}
