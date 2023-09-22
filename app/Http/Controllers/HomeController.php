<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        $featuredPosts = Post::published()->featured()->latest('published_at')->take(3)->get();
        $latestPosts = Post::published()->take(23)->get();
        return view('home',compact('featuredPosts','latestPosts'));
    }
}
