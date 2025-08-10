<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserReaction;
use Illuminate\Http\JsonResponse;


class PostReactionController extends Controller
{
public function index(int $postId): JsonResponse
    {
        $reactions = UserReaction::with(['user', 'reactionType'])
            ->where('post_id', $postId)
            ->get();

        return response()->json($reactions);
    }
}
