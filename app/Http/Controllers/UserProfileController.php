<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserProfile\StoreRequest;
use App\Http\Requests\UserProfile\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;



class UserProfileController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $userId = Auth::id();

        // Пенревіряєм наявність профіля
        $profile = UserProfile::where('user_id', $userId)->first();

        if ($profile) {
            // Якщо профіль існує — обновляем його
            $profile->update($validated);
            return response()->json($profile, 202);
        } else {
            // Якщо профіля нема — создаєм новий
            $validated['user_id'] = $userId;
            $profile = UserProfile::create($validated);
            return response()->json($profile, 201); // 201 Created — создан новый
        }
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
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile = Auth::user()->userProfile;

        if ($userProfile) {
            $userProfile->delete();
            return response()->json(['message' => 'Профіль видалено'], 204);
        }

        return response()->json(['message' => 'Профіль не знайдено'], 404);
    }
}
