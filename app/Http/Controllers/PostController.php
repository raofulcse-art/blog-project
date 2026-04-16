<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PostResource::collection(Post::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StorePostRequest $request)
    {
        //
        $inputvalues = $request->validated();
        $inputvalues['title'] = strip_tags($inputvalues['title']);
        $inputvalues['body'] = strip_tags($inputvalues['body']);
        $inputvalues['user_id'] = $request->user()->id;

        $post = Post::create($inputvalues);

        return (new PostResource($post))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Post::findOrFail($id);
        return (new PostResource($post))
        ->response()
        ->setStatusCode(200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        //
        $post = Post::findOrFail($id);
        if($post->user_id != $request->user()->id){
            return response()->json("Access Denied",403);
        }
        $inputvalues = $request->validated();
        $post->title = $inputvalues['title'];
        $post->body = $inputvalues['body'];
        $post->save();
        return (new PostResource($post))
        ->response()
        ->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
