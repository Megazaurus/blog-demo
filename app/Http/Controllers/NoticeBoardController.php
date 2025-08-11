<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeBoard\IndexRequest;
use App\Http\Requests\NoticeBoard\StoreRequest;

use App\Models\NoticeBoard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NoticeBoardController extends Controller
{

    public function show($userId)
    {
        $noticeBoard = NoticeBoard::with('posts')
            ->where('user_id', $userId)
            ->firstOrFail();

        return response()->json([
            'noticeBoard' => $noticeBoard,
            'posts' => $noticeBoard->posts,
        ]);
    }


}
