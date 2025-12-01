<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tambah Media Pendukung</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        h1 { color: #1B5AA1; }
        label { display: block; margin-top: 15px; font-weight: bold; color: #333; }
        input[type="text"], input[type="number"], textarea, input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea { min-height: 100px; resize: vertical; }
        .btn { display: inline-block; padding: 10px 20px; margin-top: 20px; border-radius: 4px; text-decoration: none; color: white; border: none; cursor: pointer; }
        .btn-success { background: #4CAF50; }
        .btn-secondary { background: #6c757d; margin-left: 10px; }
        .btn:hover { opacity: 0.9; }
        .error { color: #dc3545; font-size: 0.9em; margin-top: 5px; }
        .nav { margin-bottom: 20px; padding: 10px 0; border-bottom: 1px solid #ddd; }
        .nav a { margin-right: 15px; color: #1B5AA1; text-decoration: none; }
        .nav a:hover { text-decoration: underline; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .help-text { font-size: 0.9em; color: #666; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('beranda') }}">← Kembali ke Beranda</a>
        <a href="{{ route('admin.materials.index') }}">Materi</a>
        <a href="{{ route('admin.media.index') }}">Media Pendukung</a>
    </div>

    <h1>Tambah Media Pendukung</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Judul Media *</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="description">Deskripsi</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        <div class="help-text">Penjelasan singkat tentang media ini (opsional)</div>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="file">File *</label>
        <input type="file" id="file" name="file" required accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx">
        <div class="help-text">Format yang didukung: PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX (Maksimal 10 MB)</div>
        @error('file')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="order">Urutan *</label>
        <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0" required>
        <div class="help-text">Nomor urutan untuk menampilkan media (semakin kecil semakin di atas)</div>
        @error('order')
            <div class="error">{{ $message }}</div>
        @enderror

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-success">Simpan Media</button>
            <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</body>
</html>
