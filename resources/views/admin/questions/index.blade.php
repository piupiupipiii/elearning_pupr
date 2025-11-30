<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pertanyaan untuk SEKSI {{ $material->section_number }}</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 0 auto; padding: 20px; }
        h1 { color: #1B5AA1; }
        h2 { color: #666; font-weight: normal; margin-top: -10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background: #1B5AA1; color: white; }
        tr:nth-child(even) { background: #f9f9f9; }
        a { color: #1B5AA1; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .btn { display: inline-block; padding: 8px 16px; margin: 2px; border-radius: 4px; text-decoration: none; color: white; }
        .btn-primary { background: #1B5AA1; }
        .btn-success { background: #4CAF50; }
        .btn-warning { background: #FF9C00; }
        .btn-danger { background: #dc3545; }
        .btn:hover { opacity: 0.9; }
        .actions { white-space: nowrap; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .nav { margin-bottom: 20px; padding: 10px 0; border-bottom: 1px solid #ddd; }
        .nav a { margin-right: 15px; }
        .correct { background: #d4edda; font-weight: bold; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('admin.materials.index') }}">← Kembali ke Daftar Materi</a>
    </div>

    <h1>Pertanyaan Quiz</h1>
    <h2>SEKSI {{ $material->section_number }} - {{ $material->title }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>
        <a href="{{ route('admin.questions.create', $material) }}" class="btn btn-success">+ Tambah Pertanyaan Baru</a>
    </p>

    @if($questions->isEmpty())
        <p>Belum ada pertanyaan untuk materi ini. Silakan tambahkan pertanyaan baru.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">#</th>
                    <th>Pertanyaan</th>
                    <th>Opsi A</th>
                    <th>Opsi B</th>
                    <th>Opsi C</th>
                    <th>Opsi D</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $index => $question)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ Str::limit($question->question_text, 50) }}</td>
                        <td class="{{ $question->correct_answer === 'A' ? 'correct' : '' }}">{{ Str::limit($question->options['A'] ?? '-', 20) }}</td>
                        <td class="{{ $question->correct_answer === 'B' ? 'correct' : '' }}">{{ Str::limit($question->options['B'] ?? '-', 20) }}</td>
                        <td class="{{ $question->correct_answer === 'C' ? 'correct' : '' }}">{{ Str::limit($question->options['C'] ?? '-', 20) }}</td>
                        <td class="{{ $question->correct_answer === 'D' ? 'correct' : '' }}">{{ Str::limit($question->options['D'] ?? '-', 20) }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.questions.edit', [$material, $question]) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.questions.destroy', [$material, $question]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus pertanyaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
