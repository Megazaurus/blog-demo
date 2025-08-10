<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserReaction\StoreRequest;


class UserReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reactions = UserReaction::with(['post', 'reactionType'])
            ->where('user_id', Auth::id())
            ->get();

        return response()->json($reactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $userReaction = UserReaction::updateOrCreate(
            ['user_id' => $data['user_id'], 'post_id' => $data['post_id']],
            ['reaction_id' => $data['reaction_id']]
        );

        return response()->json(
            $userReaction, 
            201);
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
    public function destroy(UserReaction $userReaction)
    {
        if ($userReaction->user_id !== Auth::id()) {
            return response()->json(
                ['message' => 'Доступ запрещён'], 
                403);
        }

        $userReaction->delete();
        return response()->json(
            null,
            204);
    }
}
