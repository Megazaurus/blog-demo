<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AvatarImage\StoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\AvatarImage;


class AvatarImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $path = $request->file('image')->store('images', 'public');

        $image = AvatarImage::create([
            'user_id' => Auth::id(),
            'img_src' => $path,
        ]);

        return response()->json([
            'message' => 'Фото завантажено',
            'path' => '/storage/' . $path,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AvatarImage $image)
    {
        $image->delete();
        return response()->json(null, 204);
    }
}
