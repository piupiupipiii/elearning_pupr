<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ $material ? 'Edit' : 'Tambah' }} Materi</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        h1 { color: #1B5AA1; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input[type="text"], input[type="number"], textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 100px; resize: vertical; }
        .btn { display: inline-block; padding: 10px 20px; margin-right: 10px; border-radius: 4px; text-decoration: none; color: white; border: none; cursor: pointer; font-size: 16px; }
        .btn-primary { background: #1B5AA1; }
        .btn-secondary { background: #6c757d; }
        .btn:hover { opacity: 0.9; }
        .nav { margin-bottom: 20px; padding: 10px 0; border-bottom: 1px solid #ddd; }
        .nav a { color: #1B5AA1; text-decoration: none; }
        .error { color: #dc3545; font-size: 14px; margin-top: 5px; }
        .hint { color: #666; font-size: 13px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('admin.materials.index') }}">← Kembali ke Daftar Materi</a>
    </div>

    <h1>{{ $material ? 'Edit' : 'Tambah' }} Materi</h1>

    <form action="{{ $material ? route('admin.materials.update', $material) : route('admin.materials.store') }}" method="POST">
        @csrf
        @if($material)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="section_number">Nomor Seksi</label>
            <input type="text" id="section_number" name="section_number"
                   value="{{ old('section_number', $material->section_number ?? '') }}"
                   placeholder="Contoh: 1.1" required>
            <div class="hint">Format: 1.1, 1.2, 2.1, dst.</div>
            @error('section_number')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $material->title ?? '') }}"
                   placeholder="Contoh: Ringkasan Pekerjaan" required>
            @error('title')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea id="description" name="description"
                      placeholder="Deskripsi singkat tentang materi ini...">{{ old('description', $material->description ?? '') }}</textarea>
            @error('description')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="youtube_url">YouTube URL/ID</label>
            <input type="text" id="youtube_url" name="youtube_url"
                   value="{{ old('youtube_url', $material->youtube_url ?? '') }}"
                   placeholder="Contoh: https://www.youtube.com/watch?v=dQw4w9WgXcQ atau dQw4w9WgXcQ" required>
            <div class="hint">Bisa berupa URL lengkap atau ID video saja (11 karakter).</div>
            @error('youtube_url')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="order">Urutan</label>
            <input type="number" id="order" name="order"
                   value="{{ old('order', $material->order ?? 0) }}"
                   min="0" required>
            <div class="hint">Materi akan ditampilkan berdasarkan urutan ini. Materi pertama (urutan terkecil) akan terbuka secara default.</div>
            @error('order')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $material ? 'Simpan Perubahan' : 'Tambah Materi' }}</button>
            <a href="{{ route('admin.materials.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</body>
</html>
