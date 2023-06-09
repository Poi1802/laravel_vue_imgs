<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function __invoke()
  {
    $post = Post::latest()->first();
    // $post = Post::find(6);

    return new PostResource($post);
  }
}