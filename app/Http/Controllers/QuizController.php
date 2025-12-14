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

        // Parse answers from JSON format (new quiz system sends JSON)
        $answersJson = $request->input('answers');
        $answers = json_decode($answersJson, true);

        // Initialize score counters
        $correctAnswersCount = 0;
        $totalQuestionsCount = $material->questions->count();

        if ($answers && is_array($answers)) {
            // Save all answers from JSON format
            foreach ($answers as $questionId => $selectedAnswer) {
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $questionId,
                    'selected_answer' => $selectedAnswer,
                ]);

                // Check if answer is correct
                $question = Question::find($questionId);
                if ($question && $question->correct_answer === $selectedAnswer) {
                    $correctAnswersCount++;
                }
            }
        } else {
            // Fallback to old format
            $questions = $material->questions;
            foreach ($questions as $question) {
                $answerKey = 'question_' . $question->id;
                if ($request->has($answerKey)) {
                    $selectedAnswer = $request->input($answerKey);
                    UserAnswer::create([
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                        'selected_answer' => $selectedAnswer,
                    ]);

                    if ($question->correct_answer === $selectedAnswer) {
                        $correctAnswersCount++;
                    }
                }
            }
        }

        // Calculate score
        $score = ($totalQuestionsCount > 0) ? round(($correctAnswersCount / $totalQuestionsCount) * 100) : 0;

        // Save Score
        \App\Models\QuizScore::create([
            'user_id' => $user->id,
            'material_id' => $material->id,
            'score' => $score,
            'correct_answers' => $correctAnswersCount,
            'total_questions' => $totalQuestionsCount,
        ]);

        // Mark current material as done
        $progress->update(['status' => 'done']);

        // Unlock next material
        $this->unlockNextMaterial($user, $material);

        return redirect()->route('submenu')->with('success', 'Quiz selesai! Materi berikutnya telah dibuka.');
    }

    /**
     * Validate single answer via AJAX
     */
    public function validateAnswer(Request $request, Question $question)
    {
        $selectedAnswer = $request->input('answer');
        $isCorrect = $selectedAnswer === $question->correct_answer;

        return response()->json([
            'correct' => $isCorrect,
            'correct_answer' => $question->correct_answer,
        ]);
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
