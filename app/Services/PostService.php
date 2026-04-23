<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class PostService{

    public function getAllPosts(){
        return Cache::remember('posts_all',3600,function(){
            return Post::all();
        });
    }
    public function createPosts($inputvalues){
        return Cache::remember('create_post',3600,function() use ($inputvalues){
            return Post::create($inputvalues);
        });
    }
}
