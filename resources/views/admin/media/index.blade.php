<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Media Pendukung</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 0 auto; padding: 20px; }
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
        .btn-danger { background: #dc3545; border: none; cursor: pointer; }
        .btn:hover { opacity: 0.9; }
        .actions { white-space: nowrap; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .nav { margin-bottom: 20px; padding: 10px 0; border-bottom: 1px solid #ddd; }
        .nav a { margin-right: 15px; }
        .file-type { display: inline-block; padding: 4px 8px; background: #FF9C00; color: white; border-radius: 4px; font-size: 0.85em; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="{{ route('beranda') }}">← Kembali ke Beranda</a>
        <a href="{{ route('admin.materials.index') }}">Materi</a>
        <a href="{{ route('admin.media.index') }}"><strong>Media Pendukung</strong></a>
    </div>

    <h1>Daftar Media Pendukung</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <p>
        <a href="{{ route('admin.media.create') }}" class="btn btn-success">+ Tambah Media Baru</a>
    </p>

    @if($media->isEmpty())
        <p>Belum ada media pendukung. Silakan tambahkan media baru.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tipe File</th>
                    <th>Ukuran</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($media as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td>{{ Str::limit($item->description, 50) ?? '-' }}</td>
                        <td><span class="file-type">{{ strtoupper($item->file_type) }}</span></td>
                        <td>{{ $item->formatted_size }}</td>
                        <td>{{ $item->order }}</td>
                        <td class="actions">
                            <a href="{{ route('media.download', $item) }}" class="btn btn-primary">Download</a>
                            <form action="{{ route('admin.media.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus media ini?')">
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
