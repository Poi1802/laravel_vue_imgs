<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
  public function __invoke(StoreRequest $request)
  {
    $data = $request->validated();
    $imgs = $data['imgs'];
    unset($data['imgs']);

    $post = Post::create($data);

    foreach ($imgs as $img) {
      $path = Storage::disk('public')->put('/images', $img);

      Image::create([
        'path' => $path,
        'url' => url('storage', $path),
        'post_id' => $post->id
      ]);
    }

    return response(['message' => 'Post created']);
  }
}