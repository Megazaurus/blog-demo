<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(IndexRequest $request)
    {
        $data = $request->validated();
        $page = $request->input("page", 1);
        $count = $request->input("count", 10);

        $posts = Post::query()
            ->when(array_key_exists('content', $data) && $data['content'], fn($query) => $query->where('content', 'like', '%' . $data['content'] . '%'))
            ->when(array_key_exists('user_id', $data) && $data['user_id'], fn($query) => $query->where('user_id', $data['user_id']))
            ->paginate(perPage: $count, page: $page);
        

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $posts = Post::create($validated);
        return response()->json($posts, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $posts)
    {
        $posts->load('postImages');
        return response()->json($posts);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Post $posts)
    {
        $posts->update($request->validated());
        return response()->json($posts, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $posts)
    {
        $posts->delete();
        return response()->json(null, 204);
    }
}
