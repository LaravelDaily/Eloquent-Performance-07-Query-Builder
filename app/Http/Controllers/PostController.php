<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
//        $posts = Post::with('user')
//            ->where('title', 'like', '%a%')
//            ->get();
//
//        $posts = DB::table('posts')
//            ->join('users', 'users.id', '=', 'posts.user_id')
//            ->where('title', 'like', '%a%')
//            ->get();
//
//        $posts = DB::select("select * from posts join users on posts.user_id = users.id
//            where title like '%a%'");

        $posts = Post::with('user')
            ->whereHas('user', function($query) {
                $query->where('name', 'like', '%a%');
            })
            ->get();

        $posts = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->where('users.name', 'like', '%a%')
            ->get();

        return view('posts.index', compact('posts'));
    }
}
