<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Materi</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 0 auto; padding: 20px; }
        h1 { color: #1B5AA1; }
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
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('beranda') }}">← Kembali ke Beranda</a>
        <a href="{{ route('admin.materials.index') }}"><strong>Materi</strong></a>
    </div>

    <h1>Daftar Materi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>
        <a href="{{ route('admin.materials.create') }}" class="btn btn-success">+ Tambah Materi Baru</a>
    </p>

    @if($materials->isEmpty())
        <p>Belum ada materi. Silakan tambahkan materi baru.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Seksi</th>
                    <th>Judul</th>
                    <th>YouTube URL</th>
                    <th>Pertanyaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $material)
                    <tr>
                        <td>{{ $material->order }}</td>
                        <td>{{ $material->section_number }}</td>
                        <td>{{ $material->title }}</td>
                        <td>{{ Str::limit($material->youtube_url, 30) }}</td>
                        <td>{{ $material->questions->count() }}</td>
                        <td class="actions">
                            <a href="{{ route('admin.questions.index', $material) }}" class="btn btn-primary">Pertanyaan</a>
                            <a href="{{ route('admin.materials.edit', $material) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus materi ini?')">
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
