<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\StoreRequest;
use App\Http\Requests\UserProfile\UpdateRequest;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
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
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $profile = UserProfile::create($validated);
        return response()->json($profile, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $profile = UserProfile::where('user_id', $userId)->first();

        if (!$profile) {
            return response()->json(['message' => 'Профиль не найден'], 404);
        }

        return response()->json($profile);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, UserProfile $user)
    {
        $data = $request->validated();
        $user = Auth::user();
        $profile = $user->userProfile;

        if (!$profile) {

            return response()->json(['message' => 'Профіль не знайдено'], 404);
        }

        $profile->update($data);

        return response()->json($profile, 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $profile)
    {
        $profile = Auth::user()->userProfile;

        if ($profile) {
            $profile->delete();
            return response()->json(null, 204);
        }

        return response()->json(['message' => 'Профиль не найден'], 404);
    }
}
