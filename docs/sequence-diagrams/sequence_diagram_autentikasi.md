# Sequence Diagram System E-Learning SMKK

Dokumen ini berisi sequence diagram yang telah dikonsolidasikan sesuai standar laporan Kerja Praktek, berdasarkan Use Case Diagram System E-learning SMKK.

---

## 1. Sequence Diagram: Login Pengguna

Proses login dimulai ketika pengguna mengakses halaman login dan mengisi form dengan email serta password, kemudian sistem memvalidasi kredensial melalui AuthController, dan jika valid maka sistem membuat session dan mengarahkan user ke halaman Pengantar Modul.

![Sequence Diagram Login](c:/laragon/www/elearning/docs/sequence-diagrams/01_login.png)

### Penjelasan Alur Login

**Langkah-langkah:**
1. Pengguna mengakses halaman `/login` melalui browser
2. Sistem menampilkan form dengan field email dan password
3. Pengguna mengisi kredensial dan menekan tombol "Masuk"
4. AuthController menerima request dan memanggil method `getUserByEmail()` untuk mencari data user
5. Jika user ditemukan, sistem memverifikasi password menggunakan `verifyPassword()`
6. Apabila password cocok, sistem membuat session baru melalui `createSession()`
7. Pengguna diarahkan ke halaman Pengantar Modul dengan status terautentikasi

**Kesimpulan:** Proses autentikasi login menerapkan pola Boundary-Control-Entity dimana validasi dilakukan sepenuhnya di layer Controller, bukan di database. Penggunaan session memastikan pengguna tetap terautentikasi selama sesi aktif tanpa perlu login berulang.

---

## 2. Sequence Diagram: Registrasi Pengguna

Proses registrasi memungkinkan pengguna baru untuk membuat akun dengan mengisi form yang berisi nama, email, dan password, kemudian sistem memvalidasi input dan menyimpan data user baru ke database.

![Sequence Diagram Registrasi](c:/laragon/www/elearning/docs/sequence-diagrams/02_registrasi.png)

### Penjelasan Alur Registrasi

**Langkah-langkah:**
1. Pengguna mengakses halaman `/signup` melalui link "Daftar" di halaman login
2. Sistem menampilkan form registrasi dengan field nama, email, password, dan konfirmasi password
3. Pengguna mengisi semua field dan menekan tombol "Daftar"
4. AuthController melakukan validasi format input (email valid, password minimal 8 karakter dengan kombinasi huruf besar, kecil, dan angka)
5. Sistem mengecek apakah email sudah terdaftar di database
6. Jika email belum terdaftar, password di-hash menggunakan algoritma bcrypt untuk keamanan
7. Data user baru disimpan ke tabel `users`
8. Pengguna diarahkan ke halaman login dengan notifikasi sukses

**Kesimpulan:** Registrasi menerapkan validasi berlapis untuk memastikan integritas data. Password tidak pernah disimpan dalam bentuk plain text, melainkan di-hash terlebih dahulu untuk mencegah kebocoran data sensitif jika database diakses pihak tidak berwenang.

---

## 3. Sequence Diagram: Logout Pengguna

Proses logout dimulai ketika pengguna menekan tombol logout, kemudian sistem menghapus session user dan mengarahkan kembali ke halaman login.

![Sequence Diagram Logout](c:/laragon/www/elearning/docs/sequence-diagrams/03_logout.png)

### Penjelasan Alur Logout

**Langkah-langkah:**
1. Pengguna mengklik icon profil di pojok kanan atas header
2. Dropdown menu muncul menampilkan opsi "Logout"
3. Pengguna memilih menu "Logout"
4. AuthController menerima request dan memerintahkan Session Manager untuk menghapus session aktif
5. Session diinvalidasi dan CSRF token di-regenerasi untuk keamanan
6. Pengguna diarahkan kembali ke halaman login

**Kesimpulan:** Proses logout menggunakan method POST untuk mencegah serangan CSRF (Cross-Site Request Forgery). Session benar-benar dihapus dari server, bukan hanya expired, sehingga tidak ada kemungkinan sesi lama digunakan kembali oleh pihak tidak berwenang.

---

## 4. Sequence Diagram: Akses Modul Pembelajaran

Proses akses modul pembelajaran dimulai dari halaman Pengantar Modul yang merupakan landing page. Jika user belum login, sistem menampilkan tombol Login dan mengarahkan ke halaman login. Setelah login berhasil, user kembali ke halaman Pengantar Modul dengan tombol "Mulai" yang aktif, kemudian diarahkan ke Beranda Modul yang menampilkan 3 card menu utama.

![Sequence Diagram Akses Modul](c:/laragon/www/elearning/docs/sequence-diagrams/04_akses_modul.png)

### Penjelasan Alur Akses Modul

**Langkah-langkah:**
1. Pengguna mengakses halaman utama sistem (route `/`)
2. Sistem me-render halaman Pengantar Modul yang berisi informasi tentang SMKK
3. Sistem mengecek status autentikasi pengguna
4. Jika belum login, tombol "Login" ditampilkan dan mengarahkan ke halaman autentikasi
5. Jika sudah login, tombol "Mulai" ditampilkan untuk melanjutkan ke pembelajaran
6. Ketika pengguna klik "Mulai", sistem mengarahkan ke Beranda Modul (`/beranda`)
7. Beranda menampilkan 3 card menu: Kompetensi Dasar, Video Materi, dan Media Pendukung

**Kesimpulan:** Halaman Pengantar Modul berfungsi sebagai gerbang utama yang mengontrol akses ke fitur pembelajaran. Dengan menampilkan tombol berbeda berdasarkan status login, sistem memastikan pengalaman pengguna yang seamless tanpa perlu menampilkan error akses ditolak.

---

## 5. Sequence Diagram: Akses dan Menonton Materi Video

Proses akses materi video dimulai ketika user memilih menu "Video Materi" dari Beranda, sistem menampilkan slider kartu materi dengan status progress masing-masing. User memilih materi yang unlocked, kemudian video dimuat dari local storage dan ditampilkan menggunakan HTML5 video player. Setelah video selesai ditonton, tombol "Next ke Quiz" aktif untuk melanjutkan ke evaluasi.

![Sequence Diagram Video](c:/laragon/www/elearning/docs/sequence-diagrams/05_akses_menonton_video.png)

### Penjelasan Alur Akses dan Menonton Video

**Langkah-langkah:**
1. Pengguna mengklik card "Video Materi" di Beranda Modul
2. MaterialController mengambil daftar semua materi dari Entity Material
3. Controller juga mengambil data progress pengguna untuk menentukan status setiap materi
4. Jika pengguna baru dan belum memiliki progress, sistem melakukan inisialisasi dengan membuka materi pertama
5. Halaman submenu ditampilkan dengan slider kartu yang menunjukkan status: Locked (terkunci), Unlocked (terbuka), atau Done (selesai)
6. Pengguna memilih materi yang statusnya Unlocked
7. Controller memvalidasi akses pengguna ke materi tersebut
8. Video dimuat dari folder `public/video/` menggunakan HTML5 video player
9. Setelah video selesai ditonton, JavaScript mengaktifkan tombol "Next ke Quiz"
10. Pengguna dapat melanjutkan ke evaluasi quiz

**Kesimpulan:** Sistem menerapkan mekanisme pembelajaran terstruktur dimana materi harus diselesaikan secara berurutan. Video disimpan secara lokal untuk mengurangi ketergantungan pada koneksi internet dan mempercepat waktu loading dibandingkan streaming dari server eksternal.

---

## 6. Sequence Diagram: Mengelola Kuis Evaluasi

Proses quiz dimulai ketika user mengakses halaman quiz setelah menonton video. Sistem mengambil soal dari bank soal, user menjawab setiap soal dengan validasi real-time, kemudian sistem menghitung skor, menyimpan hasil, dan membuka materi berikutnya.

![Sequence Diagram Quiz](c:/laragon/www/elearning/docs/sequence-diagrams/09_quiz.png)

### Penjelasan Alur Kuis Evaluasi

**Langkah-langkah:**
1. Pengguna mengakses halaman quiz setelah menyelesaikan video materi
2. QuizController memvalidasi apakah pengguna memiliki akses ke quiz tersebut
3. Jika punya akses, Controller memanggil `getRandomQuestions()` untuk mengambil soal secara acak dari bank soal
4. Halaman quiz menampilkan soal pertama dengan 4 pilihan jawaban (A, B, C, D)
5. Pengguna memilih jawaban, sistem melakukan validasi real-time melalui method `validateAnswer()`
6. Controller mengecek kebenaran jawaban dengan `cekJawabanBenar()` dan memberikan feedback visual
7. Proses diulang untuk setiap soal (loop)
8. Setelah semua soal dijawab, pengguna submit quiz
9. Controller menghitung skor dengan `hitungSkor()` dan menyimpan hasil ke Entity
10. Sistem memanggil `unlockNextMaterial()` untuk membuka materi berikutnya
11. Pengguna diarahkan kembali ke daftar materi dengan fokus pada materi yang baru dibuka

**Kesimpulan:** Quiz menerapkan validasi real-time untuk memberikan pengalaman interaktif kepada pengguna. Penggunaan soal acak memastikan setiap sesi quiz berbeda, mencegah pengguna menghafal urutan jawaban. Sistem otomatis membuka materi berikutnya sebagai reward menyelesaikan evaluasi.

---

## 7. Sequence Diagram: Melihat Progres Pembelajaran

Proses melihat progres pembelajaran dimulai ketika user mengklik menu Profile. Sistem mengambil data jumlah materi yang sudah diselesaikan, total materi, dan riwayat skor quiz, kemudian menampilkan informasi progress secara keseluruhan.

![Sequence Diagram Progres](c:/laragon/www/elearning/docs/sequence-diagrams/10_progres.png)

### Penjelasan Alur Progres Pembelajaran

**Langkah-langkah:**
1. Pengguna mengklik icon profil dan memilih menu "Profile"
2. ProfileController menerima request dan memanggil `getProfile()`
3. Controller mengambil jumlah materi yang sudah selesai dengan `getProgressCount()`
4. Controller mengambil total materi yang tersedia dengan `getTotalMaterials()`
5. Controller mengambil semua skor quiz pengguna dengan `getQuizScores()`
6. Dengan data tersebut, Controller menghitung rata-rata nilai menggunakan `hitungRataRata()`
7. Semua data dikompilasi dan dikirim ke Boundary untuk ditampilkan
8. Halaman profil menampilkan informasi: jumlah video selesai, rata-rata nilai, dan riwayat nilai per materi

**Kesimpulan:** Fitur progres memberikan transparansi kepada pengguna tentang pencapaian pembelajaran mereka. Data statistik dihitung secara real-time dari database, memastikan informasi selalu akurat dan up-to-date setiap kali halaman diakses.

---

## 8. Sequence Diagram: Mengelola Profil Pengguna

Proses melihat profil dimulai ketika user mengklik menu Profile dari dropdown. Sistem mengambil data user dan statistik pembelajaran untuk ditampilkan dalam halaman profil.

![Sequence Diagram Profil](c:/laragon/www/elearning/docs/sequence-diagrams/12_profil.png)

### Penjelasan Alur Profil Pengguna

**Langkah-langkah:**
1. Pengguna mengklik icon profil di header aplikasi
2. Dropdown menu muncul menampilkan nama pengguna dan opsi "Profile"
3. Pengguna memilih menu "Profile"
4. ProfileController memanggil `getProfile()` untuk mengumpulkan data
5. Controller mengambil informasi akun pengguna dengan `getUserData()`
6. Controller menghitung statistik pembelajaran dengan `getStatistik()`
7. Data lengkap dikirim ke halaman profil untuk ditampilkan
8. Halaman menampilkan avatar, nama, email, progress video, dan riwayat nilai

**Kesimpulan:** Halaman profil menyajikan ringkasan lengkap identitas dan pencapaian pengguna dalam satu tampilan. Integrasi data akun dengan statistik pembelajaran menciptakan dashboard personal yang memotivasi pengguna untuk terus belajar dan meningkatkan pencapaian.

---

## Penjelasan Use Case Tambahan (Tanpa Diagram)

### Mengakses Media Pendukung
Halaman Media Pendukung menyediakan file-file pendukung pembelajaran seperti PDF, DOCX, dan PPTX. User dapat mengakses halaman ini melalui card "Media Pendukung" dari Beranda Modul. Controller mengambil daftar file dari database dan menampilkannya dalam bentuk daftar dengan informasi nama file, tipe, dan ukuran. Ketika user klik tombol download, sistem melakukan streaming file dari storage ke browser.

### Mengakses Informasi Bantuan (FAQ)
Halaman FAQ menyediakan informasi bantuan dalam format accordion dengan 7 kategori pertanyaan yang mencakup: Pertanyaan Umum, Navigasi Modul, Video Materi, Menonton Video, Quiz, Media Pendukung, dan Profil Pengguna. Halaman ini bersifat statis dan dapat diakses dari halaman manapun melalui icon bantuan (?) tanpa memerlukan login. Interaksi dilakukan murni di sisi client menggunakan JavaScript untuk expand/collapse accordion.

### Melihat Kompetensi Dasar
Halaman Kompetensi Dasar menampilkan pendahuluan dan tujuan pembelajaran SMKK. Konten halaman mencakup deskripsi tentang Sistem Manajemen Keselamatan Konstruksi, tujuan pelatihan, dan ilustrasi visual pendukung. Halaman ini bersifat statis tanpa interaksi database dan dapat diakses melalui card "Kompetensi Dasar" dari Beranda Modul.

---

## Ringkasan Use Case dan Sequence Diagram

| No | Use Case | Sequence Diagram | Keterangan |
|----|----------|------------------|------------|
| 1 | Melakukan autentikasi pengguna | Login, Registrasi, Logout | 3 diagram terpisah |
| 2 | Mengakses pengantar modul | Akses Modul Pembelajaran | Digabung dengan beranda |
| 3 | Mengakses beranda modul | Akses Modul Pembelajaran | Digabung dengan pengantar |
| 4 | Melihat kompetensi dasar | - | Narasi saja |
| 5 | Mengakses materi video | Akses & Menonton Video | Digabung jadi 1 |
| 6 | Menonton video materi | Akses & Menonton Video | Digabung jadi 1 |
| 7 | Mengelola kuis evaluasi | Mengelola Kuis | Diagram terpisah |
| 8 | Melihat progres pembelajaran | Melihat Progres | Diagram terpisah |
| 9 | Mengakses media pendukung | - | Narasi saja |
| 10 | Mengelola profil pengguna | Mengelola Profil | Diagram terpisah |
| 11 | Mengakses informasi bantuan | - | Narasi saja |

**Total Sequence Diagram: 8**
