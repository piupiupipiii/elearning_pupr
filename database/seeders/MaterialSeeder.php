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
                        'B' => 'Helm keselamatan dan sepatu safety',
                        'C' => 'Jas hujan',
                        'D' => 'Sarung tangan kulit',
                    ],
                    'correct_answer' => 'B',
                ],
                [
                    'question_text' => 'Siapa yang wajib menyediakan APD untuk pekerja?',
                    'options' => [
                        'A' => 'Pekerja sendiri',
                        'B' => 'Pemerintah',
                        'C' => 'Pemberi kerja/kontraktor',
                        'D' => 'Keluarga pekerja',
                    ],
                    'correct_answer' => 'C',
                ],
            ],
            '1.5' => [
                [
                    'question_text' => 'Apa langkah pertama saat terjadi keadaan darurat di lokasi konstruksi?',
                    'options' => [
                        'A' => 'Melanjutkan pekerjaan',
                        'B' => 'Memberikan pertolongan pertama',
                        'C' => 'Membunyikan alarm dan menghentikan semua pekerjaan',
                        'D' => 'Menunggu instruksi dari kantor pusat',
                    ],
                    'correct_answer' => 'C',
                ],
                [
                    'question_text' => 'Di mana titik kumpul evakuasi seharusnya berada?',
                    'options' => [
                        'A' => 'Di dalam gedung yang sedang dibangun',
                        'B' => 'Di area terbuka yang aman dan mudah diakses',
                        'C' => 'Di dekat gudang material',
                        'D' => 'Di parkiran kendaraan berat',
                    ],
                    'correct_answer' => 'B',
                ],
            ],
        ];

        return $questions[$sectionNumber] ?? [];
    }
}
