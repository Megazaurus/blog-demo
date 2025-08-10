<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostImage\StoreRequest;


class PostImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $path = $request->file('image')->store('images', 'public');

        $image = PostImage::create([
            'user_id' => Auth::id(),
            'post_id' => $request->input('post_id'),
            'img_src' => $path,
        ]);

        return response()->json([
            'message' => 'Фото завантажено',
            'path' => '/storage/' . $path,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostImage $image)
    {
        $image->delete();
        return response()->json(null, 204);
    }

}
