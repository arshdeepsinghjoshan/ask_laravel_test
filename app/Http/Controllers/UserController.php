<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $topUsers = User::withCount('posts')  
            ->orderByDesc('posts_count') 
            ->take(20)  
            ->get();

        $leaderboard = $topUsers->map(function ($user) {
            return "User {$user->username} - {$user->posts_count} posts";
        });

        return response()->json($leaderboard);
    }
}
