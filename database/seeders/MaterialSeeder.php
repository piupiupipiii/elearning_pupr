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
        // Defined materials (22 items)
        $materials = [
            // 1.1 - 1.5 (Existing)
            [
                'section_number' => '1.1',
                'title' => 'Ringkasan Pekerjaan',
                'description' => 'Ringkasan pekerjaan dan pengenalan dasar tentang Sistem Manajemen Keselamatan Konstruksi (SMKK).',
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
                'title' => 'Kantor Lapangan Dan Fasilitasnya',
                'description' => 'Standar dan persyaratan untuk kantor lapangan serta fasilitas pendukungnya.',
                'youtube_url' => '9bZkp7q19f0',
                'order' => 3,
            ],
            [
                'section_number' => '1.4',
                'title' => 'Fasilitas Dan Pelayanan Pengujian',
                'description' => 'Fasilitas laboratorium dan pelayanan pengujian untuk pengendalian mutu di lapangan.',
                'youtube_url' => 'kJQP7kiw5Fk',
                'order' => 4,
            ],
            [
                'section_number' => '1.5',
                'title' => 'Transportasi Dan Penanganan',
                'description' => 'Prosedur transportasi material dan penanganan bahan di lokasi proyek.',
                'youtube_url' => 'RgKAFK5djSk',
                'order' => 5,
            ],
            // 1.6 - 1.22 (New)
            [
                'section_number' => '1.6',
                'title' => 'Pembayaran Sertifikat Bulanan',
                'description' => 'Prosedur pengajuan dan pembayaran sertifikat bulanan (MC).',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 6,
            ],
            [
                'section_number' => '1.7',
                'title' => 'Pembayaran Bersyarat (Provisional Sums)',
                'description' => 'Penggunaan dan administrasi dana pembayaran bersyarat.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 7,
            ],
            [
                'section_number' => '1.8',
                'title' => 'Manajemen Dan Keselamatan Lalulintas',
                'description' => 'Pengaturan lalu lintas di sekitar area proyek demi keselamatan pengguna jalan dan pekerja.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 8,
            ],
            [
                'section_number' => '1.9',
                'title' => 'Kajian Teknis Lapangan (Field Engineering)',
                'description' => 'Pelaksanaan rekayasa lapangan untuk penyesuaian desain dengan kondisi aktual.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 9,
            ],
            [
                'section_number' => '1.10',
                'title' => 'Standar Rujukan',
                'description' => 'Standar-standar teknis yang menjadi rujukan dalam pelaksanaan pekerjaan.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 10,
            ],
            [
                'section_number' => '1.11',
                'title' => 'Bahan Dan Penyimpanan',
                'description' => 'Persyaratan material konstruksi dan tata cara penyimpanannya.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 11,
            ],
            [
                'section_number' => '1.12',
                'title' => 'Jadwal Pelaksanaan',
                'description' => 'Penyusunan dan pengendalian jadwal pelaksanaan pekerjaan (Time Schedule).',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 12,
            ],
            [
                'section_number' => '1.13',
                'title' => 'Building Information Modeling (BIM)',
                'description' => 'Penerapan teknologi BIM dalam pelaksanaan konstruksi.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 13,
            ],
            [
                'section_number' => '1.14',
                'title' => 'Pemeliharaan Jalan Yang Berdekatan Dan Bangunan Pelengkapnya',
                'description' => 'Kewajiban memelihara jalan akses dan bangunan sekitar proyek.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 14,
            ],
            [
                'section_number' => '1.15',
                'title' => 'Dokumen Rekaman Pekerjaan',
                'description' => 'Pembuatan as-built drawing dan dokumentasi proyek.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 15,
            ],
            [
                'section_number' => '1.16',
                'title' => 'Pekerjaan Pembersihan',
                'description' => 'Pembersihan lokasi kerja selama dan setelah pelaksanaan proyek.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 16,
            ],
            [
                'section_number' => '1.17',
                'title' => 'Pengamanan Lingkungan Hidup',
                'description' => 'Upaya perlindungan dan pengelolaan lingkungan hidup di area konstruksi.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 17,
            ],
            [
                'section_number' => '1.18',
                'title' => 'Relokasi Utilitas Dan Pelayanan Yang Ada',
                'description' => 'Prosedur pemindahan utilitas publik yang terdampak proyek.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 18,
            ],
            [
                'section_number' => '1.19',
                'title' => 'Keselamatan Dan Kesehatan Kerja',
                'description' => 'Penerapan prinsip K3 Lanjutan dalam setiap tahapan pekerjaan.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 19,
            ],
            [
                'section_number' => '1.20',
                'title' => 'Pengujian Tanah',
                'description' => 'Investigasi geoteknik dan pengujian tanah untuk pondasi jalan/jembatan.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 20,
            ],
            [
                'section_number' => '1.21',
                'title' => 'Manajemen Mutu',
                'description' => 'Penerapan sistem manajemen mutu untuk menjamin kualitas hasil pekerjaan.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 21,
            ],
            [
                'section_number' => '1.22',
                'title' => 'Sistem Manajemen Keselamatan Konstruksi',
                'description' => 'Implementasi menyeluruh SMKK sesuai peraturan yang berlaku.',
                'youtube_url' => 'dQw4w9WgXcQ',
                'order' => 22,
            ],
        ];

        // Process all materials
        foreach ($materials as $materialData) {
            $material = Material::updateOrCreate(
                ['order' => $materialData['order']], // Match by 'order' to update existing ones
                $materialData
            );

            // Create real questions if not exists
            if ($material->questions()->count() == 0) {
                $this->createQuestionsForMaterial($material);
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
