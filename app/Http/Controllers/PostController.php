<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\support\Facades\DB;

class PostController extends Controller
{
    public function __construct()
    {
       $this->middleware(['auth:sanctum','verified'])->except(['show']) ;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'post_caption'=>'string',
            'image_path'=>['required','image'],
        ]);
        $imagePath=request('image_path')->store('uploads','public');

        // auth()->user()->posts()->create([
        //     'post_caption'=>$data['post_caption'],
        //     'image_path'   =>$imagePath,
        // ]);
        // return redirect()->route('user_profile',['username' =>auth()->user()->username]);
        return view('applyFilters',["post_caption"=>$data['post_caption'],'image_path'=>$imagePath]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        if($post==null){
            abort(404);
        }
        if( $post->user->status == "private")
            {$this->authorize('view',$post);}
        return view('posts.show',['post'=>$post]);
        }

    //auth()->user()!=null ||

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if($post==null){
            abort(404);
        }
        $this->authorize('update',$post);

        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        if($post==null){
            abort(404);
        }

        $this->authorize('update',$post);
        $data=request()->validate([
            'post_caption'=>'string',
            'image_path'=>['image','nullable']
        ]);

            $imagePath=null;
        if(request('image_path')!=null){
            $imagePath=request('image_path')->store('uploads','public');
        }
        else if($post->image_path!=null){
            $imagePath=$post->image_path;

        }else{
            abort(401);
        }
    $post->update([
        'post_caption'=>$data['post_caption'],
        'image_path'=>$imagePath,
    ]);
    return redirect(auth()->user()->username);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post==null){
            abort(404);
        }
        $this->authorize('delete',$post);
        $post->delete();
        Storage::delete("public/".$post->image_path);
        return redirect(auth()->user()->username);
    }
}
