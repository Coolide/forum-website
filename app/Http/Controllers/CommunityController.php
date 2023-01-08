<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;

class CommunityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::paginate(4);
        return view('community.view-all', ['communities' => $communities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('community.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = $request->name;
        $slug = preg_replace('~[^\pL\d]+~u', '-', $slug);
        $slug = trim($slug, '-');
        $slug = preg_replace('~-+~', '-', $slug);
        $slug = strtolower($slug);

        $validatedData = $request->validate([
            'name' => 'required|unique:communities,name',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        $community = new Community;
        $community->name = $validatedData['name'];
        $community->description = $validatedData['description'];
        $community->user_id = $validatedData['user_id'];
        $community->slug = $slug;
        $community->save();

        session()->flash('message', 'New community created!');
        return redirect()->route('communities');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $community = Community::where('slug', $slug)->firstOrFail();
        $creator = User::findOrFail($community->user_id);
        $posts = Post::where('community_id', $community->id)->paginate(4);

        return view('community.view', ['community' => $community, 'posts' => $posts, 'creator' => $creator]);
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
