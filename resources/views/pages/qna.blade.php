@extends('layouts.layout')

@section('title', 'FAQ - Bantuan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/qna.css') }}">
@endpush

@section('content')
<div class="faq-container">
    <button class="btn-back" onclick="history.back()">
        <img src="{{ asset('images/icon/back.png') }}" alt="Kembali">
    </button>

    <div class="faq-header">
        <h1>Frequently Asked Questions</h1>
        <p>Pertanyaan yang sering diajukan tentang E-Learning SMKK</p>
    </div>

    <div class="faq-list">
        <!-- FAQ 1 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Apa itu E-Learning SMKK?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>E-Learning SMKK adalah platform pembelajaran online tentang Sistem Manajemen Keselamatan Konstruksi (SMKK). Platform ini menyediakan materi video pembelajaran yang dapat diakses kapan saja dan dimana saja untuk membantu Anda memahami standar keselamatan dalam proyek konstruksi.</p>
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Bagaimana cara mendaftar akun?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Untuk mendaftar akun:</p>
                <ol>
                    <li>Klik tombol "Daftar" di halaman login</li>
                    <li>Isi nama lengkap, email, dan password</li>
                    <li>Password harus minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, dan angka</li>
                    <li>Klik tombol "Daftar" untuk menyelesaikan registrasi</li>
                </ol>
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Bagaimana cara mengakses materi pembelajaran?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Setelah login, Anda dapat mengakses materi dengan langkah berikut:</p>
                <ol>
                    <li>Klik tombol "Mulai" di halaman utama</li>
                    <li>Pilih menu "Video Materi" dari Beranda Modul</li>
                    <li>Pilih materi yang sudah terbuka (tidak terkunci)</li>
                    <li>Tonton video hingga selesai</li>
                    <li>Kerjakan quiz untuk membuka materi berikutnya</li>
                </ol>
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Mengapa materi saya terkunci?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Materi terkunci karena sistem pembelajaran bersifat berurutan. Anda harus menyelesaikan materi sebelumnya beserta quiz-nya terlebih dahulu. Setelah quiz selesai, materi berikutnya akan otomatis terbuka.</p>
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Bagaimana cara mengerjakan quiz?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Quiz dapat diakses setelah menonton video materi:</p>
                <ol>
                    <li>Setelah video selesai, tombol "Next" akan muncul</li>
                    <li>Klik tombol tersebut untuk masuk ke halaman quiz</li>
                    <li>Jawab setiap pertanyaan dengan memilih salah satu opsi (A, B, C, atau D)</li>
                    <li>Setelah menjawab, sistem akan menunjukkan apakah jawaban benar atau salah</li>
                    <li>Selesaikan semua soal untuk membuka materi berikutnya</li>
                </ol>
            </div>
        </div>

        <!-- FAQ 6 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Dimana saya bisa melihat progress belajar saya?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Anda dapat melihat progress belajar di halaman Profile:</p>
                <ol>
                    <li>Klik icon profil di pojok kanan atas</li>
                    <li>Pilih "Profile" dari menu dropdown</li>
                    <li>Di halaman profile, Anda dapat melihat jumlah video yang sudah ditonton dan riwayat nilai quiz</li>
                </ol>
            </div>
        </div>

        <!-- FAQ 7 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Apa itu Media Pendukung?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Media Pendukung adalah file-file tambahan seperti PDF, DOCX, atau PPTX yang dapat diunduh untuk membantu proses pembelajaran. Anda bisa mengakses Media Pendukung dari menu "Media Pendukung" di Beranda Modul.</p>
            </div>
        </div>

        <!-- FAQ 8 -->
        <div class="faq-item">
            <div class="faq-question" onclick="toggleFaq(this)">
                <span>Apakah saya bisa mengulang quiz?</span>
                <div class="faq-icon">+</div>
            </div>
            <div class="faq-answer">
                <p>Ya, Anda dapat mengulang quiz untuk materi yang sudah pernah dikerjakan. Nilai yang ditampilkan di halaman Profile adalah nilai terbaru dari setiap quiz yang Anda kerjakan.</p>
            </div>
        </div>
    </div>
</div>

<script>
function toggleFaq(element) {
    const faqItem = element.parentElement;
    const answer = faqItem.querySelector('.faq-answer');
    const icon = element.querySelector('.faq-icon');
    
    // Close all other FAQ items
    document.querySelectorAll('.faq-item.active').forEach(item => {
        if (item !== faqItem) {
            item.classList.remove('active');
            item.querySelector('.faq-answer').style.maxHeight = null;
            item.querySelector('.faq-icon').textContent = '+';
        }
    });
    
    // Toggle current item
    if (faqItem.classList.contains('active')) {
        faqItem.classList.remove('active');
        answer.style.maxHeight = null;
        icon.textContent = '+';
    } else {
        faqItem.classList.add('active');
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.textContent = '−';
    }
}
</script>
@endsection
