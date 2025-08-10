<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeBoardRequest;
use App\Models\NoticeBoard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NoticeBoardController extends Controller
{
    public function index(IndexRequest $request)
    {
        $userId = $request->input('user_id');
        $query = NoticeBoard::query();

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $notices = $query->with('user', 'post')->paginate(15);
        return response()->json($notices);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();

        $notice = NoticeBoard::create($data);

        return response()->json($notice, 201);
    }

    public function show(NoticeBoard $notice) 
    {
        $notice->load('user', 'post');
        return response()->json($notice);
    }

    public function update(UpdateRequest $request, NoticeBoard $notice)
    {
        $this->authorizeUser($notice);
        $notice->update($request->validated());
        return response()->json($notice, 202);
    }

    public function destroy(NoticeBoard $notice) 
    {
        $this->authorizeUser($notice);
        $notice->delete();

        return response()->json(null, 204);
    }

    protected function authorizeUser(NoticeBoard $notice)
    {
        if ($notice->user_id !== Auth::id()) {
            abort(403, 'Доступа нема');
        }
    }
}
