@extends('layouts.layout')

@section('title', 'Bantuan & FAQ')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/qna.css') }}">
@endpush

@section('content')
<div class="qna-container">
    <button class="btn-back" onclick="history.back()">
        <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
    </button>

    <div class="qna-header">
        <div class="qna-icon">
            <img src="{{ asset('images/icon/qna.png') }}" alt="QnA">
        </div>
        <h1>Bantuan & FAQ</h1>
        <p>Temukan jawaban untuk pertanyaan yang sering diajukan</p>
    </div>

    <div class="faq-section">
        {{-- Kategori 1: Pertanyaan Umum --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">🔐</span>
                Pertanyaan Umum
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara mendaftar akun baru?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk mendaftar akun baru:</p>
                    <ol>
                        <li>Klik icon <strong>profil</strong> di pojok kanan atas</li>
                        <li>Pilih <strong>"Daftar"</strong> atau klik link "Belum punya akun?"</li>
                        <li>Isi nama lengkap, email, dan password</li>
                        <li>Klik tombol <strong>"Daftar"</strong></li>
                    </ol>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara login ke akun saya?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk login:</p>
                    <ol>
                        <li>Klik icon <strong>profil</strong> di pojok kanan atas</li>
                        <li>Masukkan email dan password yang sudah terdaftar</li>
                        <li>Klik tombol <strong>"Masuk"</strong></li>
                    </ol>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara logout dari akun?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk logout:</p>
                    <ol>
                        <li>Klik icon <strong>profil</strong> di pojok kanan atas</li>
                        <li>Akan muncul dropdown menu dengan nama Anda</li>
                        <li>Klik tombol <strong>"Logout"</strong></li>
                        <li>Konfirmasi dengan klik <strong>"Ya"</strong> pada popup yang muncul</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Kategori 2: Navigasi Modul --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">🧭</span>
                Navigasi Modul
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Apa saja menu yang tersedia di Beranda Modul?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Di Beranda Modul terdapat 3 menu utama:</p>
                    <ul>
                        <li><strong>Kompetensi Dasar</strong> - Berisi pendahuluan dan tujuan pembelajaran</li>
                        <li><strong>Video Materi</strong> - Berisi video pembelajaran yang tersusun dalam beberapa seksi</li>
                        <li><strong>Media Pendukung</strong> - Berisi file-file pendukung yang dapat didownload</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara mengakses Video Materi?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk mengakses Video Materi:</p>
                    <ol>
                        <li>Dari halaman Beranda Modul, klik tombol panah pada card <strong>"Video Materi"</strong></li>
                        <li>Anda akan diarahkan ke halaman Sub Menu Video Materi</li>
                        <li>Pilih seksi yang ingin dipelajari dari slider kartu</li>
                    </ol>
                    <p><em>Catatan: Anda harus login terlebih dahulu untuk mengakses Video Materi.</em></p>
                </div>
            </div>
        </div>

        {{-- Kategori 3: Video Materi / Submenu --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">🎬</span>
                Sub Menu Video Materi
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Apa arti icon gembok pada kartu materi?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Icon pada kartu materi menunjukkan status pembelajaran:</p>
                    <ul>
                        <li><strong>🔒 Gembok Terkunci</strong> - Materi belum dapat diakses. Selesaikan materi sebelumnya terlebih dahulu</li>
                        <li><strong>🔓 Gembok Terbuka</strong> - Materi dapat diakses dan siap dipelajari</li>
                        <li><strong>✓ Centang</strong> - Materi sudah selesai dipelajari dan quiz telah dikerjakan</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara membuka materi yang terkunci?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Materi dibuka secara berurutan. Untuk membuka materi berikutnya:</p>
                    <ol>
                        <li>Tonton video materi saat ini sampai selesai</li>
                        <li>Kerjakan quiz yang tersedia</li>
                        <li>Setelah quiz selesai, materi berikutnya akan terbuka secara otomatis</li>
                    </ol>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara menggunakan slider kartu?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk navigasi slider kartu:</p>
                    <ul>
                        <li>Klik tombol <strong>◀</strong> untuk melihat materi sebelumnya</li>
                        <li>Klik tombol <strong>▶</strong> untuk melihat materi berikutnya</li>
                        <li>Kartu yang paling besar (di tengah) adalah materi yang sedang aktif</li>
                        <li>Informasi materi aktif akan ditampilkan di sisi kiri layar</li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Kategori 4: Menonton Video --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">▶️</span>
                Menonton Video
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara memulai menonton video?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk memulai video:</p>
                    <ol>
                        <li>Pilih materi yang tidak terkunci dari slider</li>
                        <li>Klik tombol <strong>"Mulai"</strong> atau klik langsung pada kartu materi</li>
                        <li>Video akan otomatis diputar</li>
                    </ol>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Kenapa tombol Next/Quiz tidak bisa diklik?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Tombol Next ke Quiz akan <strong>terkunci (berwarna abu-abu)</strong> sampai video selesai ditonton.</p>
                    <p>Untuk mengaktifkan tombol:</p>
                    <ol>
                        <li>Tonton video sampai selesai (sampai akhir)</li>
                        <li>Tombol akan aktif secara otomatis</li>
                        <li>Klik tombol untuk lanjut ke Quiz</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Kategori 5: Quiz --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">📝</span>
                Quiz
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara menjawab pertanyaan quiz?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk menjawab quiz:</p>
                    <ol>
                        <li>Baca pertanyaan yang ditampilkan di kotak atas</li>
                        <li>Pilih salah satu jawaban dengan <strong>klik pada kartu pilihan</strong> (A, B, C, atau D)</li>
                        <li>Setelah memilih, sistem akan langsung menampilkan feedback benar/salah</li>
                    </ol>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Apa yang terjadi jika jawaban saya benar/salah?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Sistem akan memberikan feedback langsung:</p>
                    <ul>
                        <li><strong>✓ Jawaban Benar</strong> - Muncul animasi centang hijau dan popup berhasil</li>
                        <li><strong>✕ Jawaban Salah</strong> - Muncul tanda silang merah dan popup gagal. Jawaban yang benar akan ditandai.</li>
                    </ul>
                    <p>Setelah feedback, tombol <strong>Next</strong> akan muncul untuk lanjut ke soal berikutnya.</p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara pindah ke soal berikutnya?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Setelah menjawab pertanyaan:</p>
                    <ol>
                        <li>Tunggu feedback animasi selesai</li>
                        <li>Klik tombol <strong>panah (→)</strong> di pojok kanan bawah</li>
                        <li>Soal berikutnya akan ditampilkan</li>
                    </ol>
                    <p><em>Catatan: Pada soal terakhir, jawaban akan otomatis disubmit dan Anda akan diarahkan kembali ke Sub Menu.</em></p>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Apakah saya bisa mengulang quiz?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Ya, Anda dapat mengulang quiz kapan saja:</p>
                    <ol>
                        <li>Kembali ke halaman materi yang sudah selesai</li>
                        <li>Klik tombol Next untuk masuk ke Quiz</li>
                        <li>Nilai terbaru akan disimpan di riwayat profil Anda</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Kategori 6: Media Pendukung --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">📁</span>
                Media Pendukung
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Apa itu Media Pendukung?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Media Pendukung adalah kumpulan file tambahan yang dapat membantu pembelajaran, seperti:</p>
                    <ul>
                        <li>Dokumen PDF</li>
                        <li>Presentasi PowerPoint</li>
                        <li>File-file referensi lainnya</li>
                    </ul>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara mendownload file?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk mendownload file:</p>
                    <ol>
                        <li>Buka menu <strong>Media Pendukung</strong> dari Beranda Modul</li>
                        <li>Cari file yang ingin didownload</li>
                        <li>Klik tombol <strong>Download</strong> pada file tersebut</li>
                        <li>File akan otomatis terdownload ke perangkat Anda</li>
                    </ol>
                </div>
            </div>
        </div>

        {{-- Kategori 7: Profil Pengguna --}}
        <div class="faq-category">
            <h2 class="category-title">
                <span class="category-icon">👤</span>
                Profil Pengguna
            </h2>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Bagaimana cara melihat profil saya?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Untuk melihat profil:</p>
                    <ol>
                        <li>Pastikan Anda sudah login</li>
                        <li>Klik icon <strong>profil</strong> di pojok kanan atas</li>
                        <li>Klik tombol <strong>"Profile"</strong> pada dropdown menu</li>
                    </ol>
                </div>
            </div>

            <div class="accordion-item">
                <button class="accordion-header">
                    <span>Apa saja informasi yang bisa saya lihat di Profil?</span>
                    <span class="accordion-icon">+</span>
                </button>
                <div class="accordion-content">
                    <p>Di halaman Profil, Anda dapat melihat:</p>
                    <ul>
                        <li><strong>Informasi Akun</strong> - Nama dan email Anda</li>
                        <li><strong>Progress Video</strong> - Jumlah video yang sudah ditonton dari total video</li>
                        <li><strong>Rata-rata Nilai</strong> - Rata-rata nilai dari semua quiz yang dikerjakan</li>
                        <li><strong>Riwayat Nilai Quiz</strong> - Daftar lengkap semua quiz beserta tanggal dan nilai</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    
    accordionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const item = this.parentElement;
            const isActive = item.classList.contains('active');
            
            // Close all other accordion items
            document.querySelectorAll('.accordion-item').forEach(otherItem => {
                otherItem.classList.remove('active');
            });
            
            // Toggle current item
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
});
</script>
@endpush
