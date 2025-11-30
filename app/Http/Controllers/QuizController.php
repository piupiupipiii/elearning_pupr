<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Display the quiz for a material.
     */
    public function show(Material $material)
    {
        $user = Auth::user();

        // Check if user has access to this material
        $progress = UserProgress::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->first();

        if (!$progress) {
            abort(403, 'Anda belum bisa mengakses quiz ini.');
        }

        $questions = $material->questions;

        return view('pages.quiz', compact('material', 'questions'));
    }

    /**
     * Submit quiz answers.
     */
    public function submit(Request $request, Material $material)
    {
        $user = Auth::user();

        // Validate that user has access
        $progress = UserProgress::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->first();

        if (!$progress) {
            abort(403, 'Anda belum bisa mengakses quiz ini.');
        }

        // Save all answers (allows retakes - creates new records)
        $questions = $material->questions;
        foreach ($questions as $question) {
            $answerKey = 'question_' . $question->id;
            if ($request->has($answerKey)) {
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $question->id,
                    'selected_answer' => $request->input($answerKey),
                ]);
            }
        }

        // Mark current material as done
        $progress->update(['status' => 'done']);

        // Unlock next material
        $this->unlockNextMaterial($user, $material);

        return redirect()->route('submenu')->with('success', 'Quiz selesai! Materi berikutnya telah dibuka.');
    }

    /**
     * Unlock the next material in order.
     */
    private function unlockNextMaterial($user, $currentMaterial)
    {
        // Find the next material by order
        $nextMaterial = Material::where('order', '>', $currentMaterial->order)
            ->orderBy('order')
            ->first();

        if ($nextMaterial) {
            // Check if progress already exists for next material
            $existingProgress = UserProgress::where('user_id', $user->id)
                ->where('material_id', $nextMaterial->id)
                ->first();

            if (!$existingProgress) {
                UserProgress::create([
                    'user_id' => $user->id,
                    'material_id' => $nextMaterial->id,
                    'status' => 'unlocked',
                ]);
            }
        }
    }
}
