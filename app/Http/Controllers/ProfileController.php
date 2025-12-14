<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\QuizScore;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the user profile page.
     */
    public function index()
    {
        $user = Auth::user();

        // Calculate progress (Video watched)
        // Adjust logic if 'done' status means fully completed including quiz
        // If we strictly want 'video watched', we might need to check how progress works.
        // Assuming 'done' means material is completed.
        $watchedCount = UserProgress::where('user_id', $user->id)
            ->where('status', 'done')
            ->count();
            
        $totalMaterials = Material::count();

        // Get quiz scores
        $quizScores = QuizScore::where('user_id', $user->id)
            ->with('material') // Eager load material to show title
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.profile', compact('user', 'watchedCount', 'totalMaterials', 'quizScores'));
    }
}
