<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    /**
     * Display the submenu with all materials and their progress status.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $materials = Material::orderBy('order')->get();

        // Initialize progress for user if they don't have any
        $this->initializeUserProgress($user, $materials);

        // Get user's progress for all materials
        $userProgress = UserProgress::where('user_id', $user->id)
            ->pluck('status', 'material_id')
            ->toArray();

        // Calculate initial slider index based on focus parameter
        $initialIndex = 0;
        $focusMaterialId = $request->query('focus');
        
        if ($focusMaterialId) {
            foreach ($materials as $index => $material) {
                if ($material->id == $focusMaterialId) {
                    $initialIndex = $index;
                    break;
                }
            }
        }

        return view('pages.submenu', compact('materials', 'userProgress', 'initialIndex'));
    }

    /**
     * Display the material video page.
     */
    public function show(Material $material)
    {
        $user = Auth::user();

        // Check if user has access (unlocked or done)
        $progress = UserProgress::where('user_id', $user->id)
            ->where('material_id', $material->id)
            ->first();

        if (!$progress) {
            abort(403, 'Materi ini masih terkunci.');
        }

        return view('pages.materi-show', compact('material', 'progress'));
    }

    /**
     * Initialize user progress for all materials.
     * First material is unlocked, rest are locked (no record).
     */
    private function initializeUserProgress($user, $materials)
    {
        if ($materials->isEmpty()) {
            return;
        }

        // Check if user already has any progress
        $existingProgress = UserProgress::where('user_id', $user->id)->exists();

        if (!$existingProgress) {
            // Create unlocked status for the first material only
            $firstMaterial = $materials->first();
            UserProgress::create([
                'user_id' => $user->id,
                'material_id' => $firstMaterial->id,
                'status' => 'unlocked',
            ]);
        }
    }
}
