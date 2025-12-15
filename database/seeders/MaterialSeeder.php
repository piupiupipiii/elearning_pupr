<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Question;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Defined materials (5 items)
        $materials = [
            [
                'section_number' => '1.1',
                'title' => 'Ringkasan Pekerjaan',
                'description' => 'Video ini menjelaskan ringkasan pekerjaan dan pengenalan dasar tentang Sistem Manajemen Keselamatan Konstruksi (SMKK).',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 1,
            ],
            [
                'section_number' => '1.2',
                'title' => 'Mobilisasi',
                'description' => 'Penjelasan lengkap tentang proses mobilisasi peralatan dan tenaga kerja di lokasi konstruksi.',
                'youtube_url' => 'jNQXAC9IVRw',
                'order' => 2,
            ],
            [
                'section_number' => '1.3',
                'title' => 'Pengawasan Lapangan',
                'description' => 'Tahapan pengawasan lapangan dan prosedur keselamatan yang harus dipatuhi selama pelaksanaan pekerjaan.',
                'youtube_url' => '9bZkp7q19f0',
                'order' => 3,
            ],
            [
                'section_number' => '1.4',
                'title' => 'Peralatan Keselamatan',
                'description' => 'Mengenal berbagai jenis peralatan keselamatan kerja (APD) yang wajib digunakan di lokasi konstruksi.',
                'youtube_url' => 'kJQP7kiw5Fk',
                'order' => 4,
            ],
            [
                'section_number' => '1.5',
                'title' => 'Penanganan Darurat',
                'description' => 'Prosedur penanganan situasi darurat dan evakuasi di lokasi konstruksi.',
                'youtube_url' => 'RgKAFK5djSk',
                'order' => 5,
            ],
        ];

        // Process defined materials (1-5)
        foreach ($materials as $materialData) {
            $material = Material::firstOrCreate(
                ['order' => $materialData['order']],
                $materialData
            );

            // Create questions if not exists
            if ($material->questions()->count() == 0) {
                $this->createQuestionsForMaterial($material);
            }
        }

        // Generate remaining materials (6-22)
        for ($i = 6; $i <= 22; $i++) {
            $material = Material::firstOrCreate(
                ['order' => $i],
                [
                    'section_number' => '1.' . $i,
                    'title' => 'Materi Pembelajaran ' . $i,
                    'description' => 'Deskripsi untuk materi pembelajaran ke-' . $i . '.',
                    'youtube_url' => 'dQw4w9WgXcQ', // Placeholder
                ]
            );
            
            // Optional: Create dummy questions for these new materials too
            if ($material->questions()->count() == 0) {
                 Question::create([
                    'material_id' => $material->id,
                    'question_text' => 'Contoh pertanyaan untuk materi ' . $i . '?',
                    'options' => [
                        'A' => 'Pilihan A',
                        'B' => 'Pilihan B',
                        'C' => 'Pilihan C',
                        'D' => 'Pilihan D',
                    ],
                    'correct_answer' => 'A',
                ]);
            }
        }
    }

    /**
     * Create sample questions for a material.
     */
    private function createQuestionsForMaterial(Material $material): void
    {
        $questionsData = $this->getQuestionsForSection($material->section_number);

        foreach ($questionsData as $questionData) {
            Question::create([
                'material_id' => $material->id,
                'question_text' => $questionData['question_text'],
                'options' => $questionData['options'],
                'correct_answer' => $questionData['correct_answer'],
            ]);
        }
    }

    /**
     * Get sample questions based on section number.
     */
    private function getQuestionsForSection(string $sectionNumber): array
    {
        $questions = [
            '1.1' => [
                [
                    'question_text' => 'Apa kepanjangan dari SMKK?',
                    'options' => [
                        'A' => 'Sistem Manajemen Keselamatan Konstruksi',
                        'B' => 'Sistem Monitoring Keselamatan Kerja',
                        'C' => 'Standar Manajemen Keselamatan Konstruksi',
                        'D' => 'Sistem Manajemen Kualitas Konstruksi',
                    ],
                    'correct_answer' => 'A',
                ],
                [
                    'question_text' => 'Siapa yang bertanggung jawab atas keselamatan di lokasi konstruksi?',
                    'options' => [
                        'A' => 'Hanya pekerja lapangan',
                        'B' => 'Hanya manajer proyek',
                        'C' => 'Semua pihak yang terlibat',
                        'D' => 'Hanya pengawas K3',
                    ],
                    'correct_answer' => 'C',
                ],
                [
                    'question_text' => 'Dokumen dasar hukum penerapan SMKK adalah?',
                    'options' => [
                        'A' => 'Permen PUPR No. 21 Tahun 2019',
                        'B' => 'UU No. 1 Tahun 1970',
                        'C' => 'PP No. 50 Tahun 2012',
                        'D' => 'Semua benar',
                    ],
                    'correct_answer' => 'A',
                ],
                [
                    'question_text' => 'Tujuan utama penerapan SMKK adalah?',
                    'options' => [
                        'A' => 'Menghindari sanksi administrasi',
                        'B' => 'Mencegah kecelakaan konstruksi dan penyakit akibat kerja',
                        'C' => 'Meningkatkan biaya proyek',
                        'D' => 'Memperpanjang durasi proyek',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Komponen biaya penerapan SMKK harus masuk dalam?',
                    'options' => [
                        'A' => 'Biaya tak terduga',
                        'B' => 'Keuntungan kontraktor',
                        'C' => 'Daftar Kuantitas dan Harga (DKH)',
                        'D' => 'Gaji karyawan',
                    ],
                    'correct_answer' => 'C',
                ],
            ],
            '1.2' => [
                [
                    'question_text' => 'Apa yang dimaksud dengan mobilisasi dalam konteks konstruksi?',
                    'options' => [
                        'A' => 'Pemindahan pekerja ke lokasi lain',
                        'B' => 'Pengiriman dan persiapan peralatan serta tenaga kerja ke lokasi proyek',
                        'C' => 'Penggunaan kendaraan bermotor',
                        'D' => 'Pemberhentian proyek sementara',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Dokumen apa yang harus disiapkan sebelum mobilisasi?',
                    'options' => [
                        'A' => 'Hanya surat izin kerja',
                        'B' => 'Rencana mobilisasi, daftar peralatan, dan jadwal pengiriman',
                        'C' => 'Hanya kontrak kerja',
                        'D' => 'Tidak perlu dokumen apapun',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Hal yang perlu diperiksa saat mobilisasi alat berat adalah?',
                    'options' => [
                        'A' => 'Kondisi cat alat',
                        'B' => 'Merk alat berat',
                        'C' => 'Sertifikat Kelayakan Alat (SIA/SILO)',
                        'D' => 'Harga sewa alat',
                    ],
                    'correct_answer' => 'C',
                ],
                [
                    'question_text' => 'Demobilisasi adalah kegiatan?',
                    'options' => [
                        'A' => 'Mendatangkan alat baru',
                        'B' => 'Mengeluarkan alat dan tenaga kerja setelah proyek selesai',
                        'C' => 'Memperbaiki alat rusak',
                        'D' => 'Menambah jam kerja',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Mobilisasi tenaga kerja harus memperhatikan?',
                    'options' => [
                        'A' => 'Kompetensi dan sertifikasi pekerja',
                        'B' => 'Asal daerah pekerja',
                        'C' => 'Usia pekerja',
                        'D' => 'Jenis kelamin pekerja',
                    ],
                    'correct_answer' => 'A',
                ],
            ],
            '1.3' => [
                [
                    'question_text' => 'Apa tujuan utama pengawasan lapangan?',
                    'options' => [
                        'A' => 'Menghitung jumlah pekerja',
                        'B' => 'Memastikan pekerjaan sesuai standar dan aman',
                        'C' => 'Mengawasi jam kerja pekerja',
                        'D' => 'Mencatat pengeluaran proyek',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Kapan inspeksi keselamatan harus dilakukan?',
                    'options' => [
                        'A' => 'Hanya saat ada kecelakaan',
                        'B' => 'Sekali sebulan',
                        'C' => 'Secara berkala dan sebelum memulai pekerjaan berisiko tinggi',
                        'D' => 'Hanya di akhir proyek',
                    ],
                    'correct_answer' => 'C',
                ],
                [
                    'question_text' => 'Laporan harian proyek berisi informasi tentang?',
                    'options' => [
                        'A' => 'Cuaca, jumlah pekerja, alat, dan progress pekerjaan',
                        'B' => 'Menu makan siang pekerja',
                        'C' => 'Daftar gaji pekerja',
                        'D' => 'Jadwal libur proyek',
                    ],
                    'correct_answer' => 'A',
                ],
                [
                    'question_text' => 'Siapa yang berwenang menghentikan pekerjaan jika ditemukan kondisi tidak aman?',
                    'options' => [
                        'A' => 'Hanya direktur perusahaan',
                        'B' => 'Hanya pemilik proyek',
                        'C' => 'Petugas K3 atau Pengawas Lapangan',
                        'D' => 'Masyarakat sekitar',
                    ],
                    'correct_answer' => 'C',
                ],
                [
                    'question_text' => 'Safety Toolbox Meeting sebaiknya dilakukan kapan?',
                    'options' => [
                        'A' => 'Setiap pagi sebelum mulai bekerja',
                        'B' => 'Seminggu sekali',
                        'C' => 'Sebulan sekali',
                        'D' => 'Saat ada kecelakaan saja',
                    ],
                    'correct_answer' => 'A',
                ],
            ],
            '1.4' => [
                [
                    'question_text' => 'Apa kepanjangan dari APD?',
                    'options' => [
                        'A' => 'Alat Pelindung Diri',
                        'B' => 'Alat Perlengkapan Darurat',
                        'C' => 'Alat Pengaman Dasar',
                        'D' => 'Area Perlindungan Diri',
                    ],
                    'correct_answer' => 'A',
                ],
                [
                    'question_text' => 'APD wajib apa yang harus digunakan di semua area konstruksi?',
                    'options' => [
                        'A' => 'Kacamata hitam',
                        'B' => 'Helm keselamatan (Safety Helmet)',
                        'C' => 'Sarung tangan kulit',
                        'D' => 'Penutup telinga',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Sepatu keselamatan (Safety Shoes) berfungsi untuk?',
                    'options' => [
                        'A' => 'Agar terlihat rapi',
                        'B' => 'Melindungi kaki dari benda tajam dan kejatuhan benda berat',
                        'C' => 'Meningkatkan kecepatan berjalan',
                        'D' => 'Menjaga kebersihan kaki',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Full Body Harness wajib digunakan ketika bekerja pada ketinggian di atas?',
                    'options' => [
                        'A' => '1 meter',
                        'B' => '1.5 meter',
                        'C' => '1.8 meter',
                        'D' => '5 meter',
                    ],
                    'correct_answer' => 'C',
                ],
                [
                    'question_text' => 'Warna helm proyek biasanya menunjukkan?',
                    'options' => [
                        'A' => 'Umur pekerja',
                        'B' => 'Lamanya bekerja',
                        'C' => 'Jabatan atau peran pekerja',
                        'D' => 'Selera pekerja',
                    ],
                    'correct_answer' => 'C',
                ],
            ],
            '1.5' => [
                 [
                    'question_text' => 'Langkah pertama saat terjadi keadaan darurat adalah?',
                    'options' => [
                        'A' => 'Panik dan berteriak',
                        'B' => 'Tetap tenang dan amankan diri',
                        'C' => 'Langsung pulang ke rumah',
                        'D' => 'Mengambil foto kejadian',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Jalur evakuasi harus ditandai dengan?',
                    'options' => [
                        'A' => 'Rambu petunjuk arah yang jelas dan terlihat',
                        'B' => 'Tali rafia',
                        'C' => 'Cat semprot di tanah',
                        'D' => 'Tidak perlu ditandai',
                    ],
                    'correct_answer' => 'A',
                ],
                [
                    'question_text' => 'Titik Kumpul (Assembly Point) adalah?',
                    'options' => [
                        'A' => 'Tempat istirahat pekerja',
                        'B' => 'Lokasi aman untuk berkumpul saat evakuasi',
                        'C' => 'Tempat parkir alat berat',
                        'D' => 'Gudang penyimpanan material',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Nomor telepon darurat yang umum dihubungi adalah?',
                    'options' => [
                        'A' => 'Nomor rumah sakit terdekat, pemadam kebakaran, dan polisi',
                        'B' => 'Nomor restoran terdekat',
                        'C' => 'Nomor teman kerja',
                        'D' => 'Nomor operator seluler',
                    ],
                    'correct_answer' => 'A',
                ],
                 [
                    'question_text' => 'APAR singkatan dari?',
                    'options' => [
                        'A' => 'Alat Pemadam Api Ringan',
                        'B' => 'Alat Pelindung Api Ruangan',
                        'C' => 'Anti Panas Area Rumah',
                        'D' => 'Alat Pemisah Api Ruangan',
                    ],
                    'correct_answer' => 'A',
                ],
            ],
        ];

        return $questions[$sectionNumber] ?? [];
    }
}
