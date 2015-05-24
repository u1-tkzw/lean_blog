<?php

namespace App\Services;

use App\Post;

class Blog {
    
    /* 投稿されたポストに対する validator
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|max:255',
            'body' => 'required|max:255',
        ]);
    }
    
    public function getPosts()
    {
        $posts = Post::all();
        return $posts;
    }
    
}

