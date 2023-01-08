<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Vote;

class VoteController extends Controller
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
        $votes = Vote::all();
        if ($request->vote_type == 'post'){
            if(!Vote::where('votable_type','App\Models\Post')->where('votable_id', $request->post_id)->where('user_id', $request->user_id)->exists()){
                $new_vote = new Vote;
                $new_vote->user_id = $request->user_id;
                $new_vote->username = $request->username;
                $new_vote->votable_id = $request->post_id;
                $new_vote->votable_type = Post::class;
                $new_vote->save();
                session()->flash('message', 'Post liked!');
            }
        }else{
            if(!Vote::where('votable_type','App\Models\Comment')->where('votable_id', $request->comment_id)->where('user_id', $request->user_id)->exists()){
                $new_vote = new Vote;
                $new_vote->user_id = $request->user_id;
                $new_vote->username = $request->username;
                $new_vote->votable_id = $request->comment_id;
                $new_vote->votable_type = Comment::class;
                $new_vote->save();
                session()->flash('message', 'Comment liked!');
            }
        }

         $post = Post::findOrFail($request->post_id);
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
