<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display list of materials.
     */
    public function materialsIndex()
    {
        $materials = Material::orderBy('order')->get();
        return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show form to create a new material.
     */
    public function materialsCreate()
    {
        return view('admin.materials.form', ['material' => null]);
    }

    /**
     * Store a new material.
     */
    public function materialsStore(Request $request)
    {
        $validated = $request->validate([
            'section_number' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        Material::create($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Show form to edit a material.
     */
    public function materialsEdit(Material $material)
    {
        return view('admin.materials.form', compact('material'));
    }

    /**
     * Update a material.
     */
    public function materialsUpdate(Request $request, Material $material)
    {
        $validated = $request->validate([
            'section_number' => 'required|string|max:20',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_url' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
        ]);

        $material->update($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Delete a material.
     */
    public function materialsDestroy(Material $material)
    {
        $material->delete();
        return redirect()->route('admin.materials.index')->with('success', 'Materi berhasil dihapus.');
    }

    /**
     * Display list of questions for a material.
     */
    public function questionsIndex(Material $material)
    {
        $questions = $material->questions;
        return view('admin.questions.index', compact('material', 'questions'));
    }

    /**
     * Show form to create a new question.
     */
    public function questionsCreate(Material $material)
    {
        return view('admin.questions.form', ['material' => $material, 'question' => null]);
    }

    /**
     * Store a new question.
     */
    public function questionsStore(Request $request, Material $material)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $question = new Question();
        $question->material_id = $material->id;
        $question->question_text = $validated['question_text'];
        $question->options = [
            'A' => $validated['option_a'],
            'B' => $validated['option_b'],
            'C' => $validated['option_c'],
            'D' => $validated['option_d'],
        ];
        $question->correct_answer = $validated['correct_answer'];
        $question->save();

        return redirect()->route('admin.questions.index', $material)->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    /**
     * Show form to edit a question.
     */
    public function questionsEdit(Material $material, Question $question)
    {
        return view('admin.questions.form', compact('material', 'question'));
    }

    /**
     * Update a question.
     */
    public function questionsUpdate(Request $request, Material $material, Question $question)
    {
        $validated = $request->validate([
            'question_text' => 'required|string',
            'option_a' => 'required|string|max:255',
            'option_b' => 'required|string|max:255',
            'option_c' => 'required|string|max:255',
            'option_d' => 'required|string|max:255',
            'correct_answer' => 'required|in:A,B,C,D',
        ]);

        $question->question_text = $validated['question_text'];
        $question->options = [
            'A' => $validated['option_a'],
            'B' => $validated['option_b'],
            'C' => $validated['option_c'],
            'D' => $validated['option_d'],
        ];
        $question->correct_answer = $validated['correct_answer'];
        $question->save();

        return redirect()->route('admin.questions.index', $material)->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    /**
     * Delete a question.
     */
    public function questionsDestroy(Material $material, Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index', $material)->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
