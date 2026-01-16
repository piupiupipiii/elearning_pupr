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

        // Get 2 random questions for this quiz session
        // Note: In a real app we might want to store which questions were generated for this session to verify on submit
        // For now we will rely on the submitted answers to identify which questions were asked.
        $questions = $material->questions()->inRandomOrder()->take(2)->get();

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

        // Parse answers from JSON format
        $answersJson = $request->input('answers');
        $answers = json_decode($answersJson, true);

        // Initialize score counters
        $correctAnswersCount = 0;
        
        // Count total questions ACTUALLY ANSWERED (which should be 2)
        // This is the denominator for the score calculation
        $totalQuestionsCount = 0; 

        if ($answers && is_array($answers)) {
            $totalQuestionsCount = count($answers); // Should be 2
            
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
        } 
        // fallback removed for brevity as JS is primary method now

        // Calculate score: (Correct / Total Answered) * 100
        // If 2 questions answered: 1 correct = 50, 2 correct = 100
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

        // Unlock next material and get its ID
        $nextMaterialId = $this->unlockNextMaterial($user, $material);

        // Redirect with focus on completed material (so user sees the DONE card)
        return redirect()->route('submenu', ['focus' => $material->id])->with('success', 'Quiz selesai! Materi berikutnya telah dibuka.');
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
     * Returns the next material's ID if unlocked, null otherwise.
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

            return $nextMaterial->id;
        }

        return null;
    }
}
