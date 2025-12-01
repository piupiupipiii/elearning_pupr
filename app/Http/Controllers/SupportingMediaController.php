<?php

namespace App\Http\Controllers;

use App\Models\SupportingMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupportingMediaController extends Controller
{
    /**
     * Display supporting media page for users
     */
    public function index()
    {
        $media = SupportingMedia::orderBy('order')->get();
        return view('pages.media-pendukung', compact('media'));
    }

    /**
     * Download a media file
     */
    public function download(SupportingMedia $media)
    {
        if (!Storage::exists($media->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::download($media->file_path, $media->file_name);
    }

    /**
     * Admin: List all media
     */
    public function adminIndex()
    {
        $media = SupportingMedia::orderBy('order')->get();
        return view('admin.media.index', compact('media'));
    }

    /**
     * Admin: Show upload form
     */
    public function create()
    {
        return view('admin.media.form', ['media' => null]);
    }

    /**
     * Admin: Store uploaded media
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240', // 10MB
            'order' => 'required|integer|min:0',
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->store('supporting-media', 'public');

        SupportingMedia::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_type' => $file->getClientOriginalExtension(),
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => $file->getSize(),
            'order' => $validated['order'],
        ]);

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil ditambahkan.');
    }

    /**
     * Admin: Delete media
     */
    public function destroy(SupportingMedia $media)
    {
        // Delete file from storage
        if (Storage::exists($media->file_path)) {
            Storage::delete($media->file_path);
        }

        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Media berhasil dihapus.');
    }
}
