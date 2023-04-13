<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
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
      $prevName = 'prev_' . md5(Carbon::now() . $img->getClientOriginalName()) . '.jpg';

      Image::create([
        'path' => $path,
        'url' => url('storage', $path),
        'preview_img' => url('storage/images', $prevName),
        'post_id' => $post->id
      ]);

      \Intervention\Image\Facades\Image::make($img)->fit(100, 100)->save(storage_path('app/public/images/' . $prevName));
    }

    return response(['message' => 'Post created']);
  }
}