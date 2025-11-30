<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - {{ $question ? 'Edit' : 'Tambah' }} Pertanyaan</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 0 auto; padding: 20px; }
        h1 { color: #1B5AA1; }
        h2 { color: #666; font-weight: normal; margin-top: -10px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        input[type="text"], textarea, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 80px; resize: vertical; }
        .btn { display: inline-block; padding: 10px 20px; margin-right: 10px; border-radius: 4px; text-decoration: none; color: white; border: none; cursor: pointer; font-size: 16px; }
        .btn-primary { background: #1B5AA1; }
        .btn-secondary { background: #6c757d; }
        .btn:hover { opacity: 0.9; }
        .nav { margin-bottom: 20px; padding: 10px 0; border-bottom: 1px solid #ddd; }
        .nav a { color: #1B5AA1; text-decoration: none; }
        .error { color: #dc3545; font-size: 14px; margin-top: 5px; }
        .options-group { background: #f9f9f9; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
        .options-group h3 { margin-top: 0; color: #1B5AA1; }
        .option-row { display: flex; gap: 10px; align-items: center; margin-bottom: 10px; }
        .option-label { width: 30px; font-weight: bold; color: #1B5AA1; }
        .option-input { flex: 1; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('admin.questions.index', $material) }}">← Kembali ke Daftar Pertanyaan</a>
    </div>

    <h1>{{ $question ? 'Edit' : 'Tambah' }} Pertanyaan</h1>
    <h2>SEKSI {{ $material->section_number }} - {{ $material->title }}</h2>

    <form action="{{ $question ? route('admin.questions.update', [$material, $question]) : route('admin.questions.store', $material) }}" method="POST">
        @csrf
        @if($question)
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="question_text">Pertanyaan</label>
            <textarea id="question_text" name="question_text"
                      placeholder="Tulis pertanyaan di sini..." required>{{ old('question_text', $question->question_text ?? '') }}</textarea>
            @error('question_text')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="options-group">
            <h3>Pilihan Jawaban</h3>

            <div class="option-row">
                <span class="option-label">A.</span>
                <input type="text" class="option-input" id="option_a" name="option_a"
                       value="{{ old('option_a', $question->options['A'] ?? '') }}"
                       placeholder="Opsi A" required>
            </div>
            @error('option_a')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="option-row">
                <span class="option-label">B.</span>
                <input type="text" class="option-input" id="option_b" name="option_b"
                       value="{{ old('option_b', $question->options['B'] ?? '') }}"
                       placeholder="Opsi B" required>
            </div>
            @error('option_b')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="option-row">
                <span class="option-label">C.</span>
                <input type="text" class="option-input" id="option_c" name="option_c"
                       value="{{ old('option_c', $question->options['C'] ?? '') }}"
                       placeholder="Opsi C" required>
            </div>
            @error('option_c')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="option-row">
                <span class="option-label">D.</span>
                <input type="text" class="option-input" id="option_d" name="option_d"
                       value="{{ old('option_d', $question->options['D'] ?? '') }}"
                       placeholder="Opsi D" required>
            </div>
            @error('option_d')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="correct_answer">Jawaban Benar</label>
            <select id="correct_answer" name="correct_answer" required>
                <option value="">-- Pilih Jawaban Benar --</option>
                <option value="A" {{ old('correct_answer', $question->correct_answer ?? '') === 'A' ? 'selected' : '' }}>A</option>
                <option value="B" {{ old('correct_answer', $question->correct_answer ?? '') === 'B' ? 'selected' : '' }}>B</option>
                <option value="C" {{ old('correct_answer', $question->correct_answer ?? '') === 'C' ? 'selected' : '' }}>C</option>
                <option value="D" {{ old('correct_answer', $question->correct_answer ?? '') === 'D' ? 'selected' : '' }}>D</option>
            </select>
            @error('correct_answer')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{ $question ? 'Simpan Perubahan' : 'Tambah Pertanyaan' }}</button>
            <a href="{{ route('admin.questions.index', $material) }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</body>
</html>
