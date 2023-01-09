<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Community;
use App\Models\User;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Notification;

class CommentController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'description' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        $comment = new Comment;
        $comment->user_id = $validatedData['user_id'];
        $comment->post_id = $validatedData['post_id'];
        $comment->description = $validatedData['description'];
        $user = User::findOrFail($request->user_id);
        $comment->username = $user->username;
        $comment->save();

        $post = Post::findOrFail($request->post_id);
        session()->flash('message', 'New comment created!');
        return redirect()->route('show.post', ['slug' => $post->slug]);
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
        $comment = Comment::findOrFail($id);
        $post = Post::findOrFail($comment->post_id);
        return view('comment.edit', ['comment' => $comment, 'post' => $post]);
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
        $comment = Comment::find($id);
        $comment->description = $request->description;
        $comment->update();

        $post = Post::findOrFail($request->post_id);
        $creator = User::findOrFail($post->user_id);
        $community = Community::findOrFail($post->community_id);
        $votes = Vote::all();

        if($comment->user_id != $request->user_id){
            Notification::firstOrCreate(['description' => "Your recent comment has been edited.", 'user_id' => $comment->user_id]);
        }

        session()->flash('message', 'Comment edited!');
        return view('post.view', ['post' => $post, 'creator' => $creator, 'community' => $community, 'votes' => $votes]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $comment = Comment::find($id);
        if($comment->user_id != $request->user_id){
            Notification::firstOrCreate(['description' => "Your recent comment has been deleted.", 'user_id' => $comment->user_id]);
        }
        $post = Post::findOrFail($comment->post_id);
        $comment->delete();


        $creator = User::findOrFail($post->user_id);
        $community = Community::findOrFail($post->community_id);
        $votes = Vote::all();
        session()->flash('message', 'Comment deleted!');
        return view('post.view', ['post' => $post, 'creator' => $creator, 'community' => $community, 'votes' => $votes]);
    }
}
