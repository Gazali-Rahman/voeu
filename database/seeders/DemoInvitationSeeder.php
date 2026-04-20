<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DemoInvitationSeeder extends Seeder
{
    public function run()
    {
        $catalogs = Catalog::all();
        $admin = User::first();

        // Inisialisasi Faker dengan lokalisasi Indonesia
        $faker = \Faker\Factory::create('en_US');

        foreach ($catalogs as $catalog) {
            // Generate Nama Unik tiap kali loop
            $groomFirstName = $faker->firstNameMale;
            $groomLastName  = $faker->lastName;
            $brideFirstName = $faker->firstNameFemale;
            $brideLastName  = $faker->lastName;
            $order = Order::updateOrCreate(
                ['slug' => 'order-demo-' . $catalog->slug], // Pencarian berdasarkan slug
                [
                    'external_id' => 'DEMO-' . strtoupper($catalog->slug), // Tambahkan ini agar tidak null
                    'user_id' => $admin->id ?? 1,
                    'catalog_id' => $catalog->id,
                    'customer_name' => 'Demo User', // Tambahkan field fillable lainnya
                    'customer_phone' => '08123456789',
                    'groom_name' => $groomFirstName,
                    'bride_name' => $brideFirstName,
                    'amount' => 0, // Set 0 untuk demo
                    'status' => 'selesai', // Sesuai status yang kamu mau
                    'checkout_url' => '#',
                ]
            );
            $photos = [
                ['label' => 'c1', 'path' => "demo/{$catalog->slug}/c1.png"],
                ['label' => 'c2', 'path' => "demo/{$catalog->slug}/c2.png"],
                ['label' => 'bridge', 'path' => "demo/{$catalog->slug}/bridge.png"],
                ['label' => 'groom', 'path' => "demo/{$catalog->slug}/groom.png"],
            ];
            $directoryPath = public_path("storage/demo/{$catalog->slug}");
            if (File::exists($directoryPath)) {
                $allFiles = File::files($directoryPath);

                foreach ($allFiles as $file) {
                    $fileName = $file->getFilename();

                    // Filter: Hanya ambil yang mengandung kata 'gallery'
                    if (str_contains(strtolower($fileName), 'gallery')) {
                        $label = pathinfo($fileName, PATHINFO_FILENAME);

                        $photos[] = [
                            'label' => $label,
                            'path' => "demo/{$catalog->slug}/{$fileName}"
                        ];
                    }
                }
            }
            Invitation::updateOrCreate(
                ['slug' => 'demo-' . $catalog->slug],
                [
                    'order_id' => $order->id,
                    'catalog_id' => $catalog->id,
                    'is_active' => true,
                    'content' => [
                        'nama_pria' => $groomFirstName,
                        'nama_pria_lengkap' => $groomFirstName . ' ' . $groomLastName . ', S.T.',
                        'nama_wanita' => $brideFirstName,
                        'nama_wanita_lengkap' => $brideFirstName . ' ' . $brideLastName . ', S.E.',
                        'ayah_pria' => 'Bpk. ' . $faker->name('male'),
                        'ibu_pria' => 'Ibu ' . $faker->name('female'),
                        'ayah_wanita' => 'Bpk. ' . $faker->name('male'),
                        'ibu_wanita' => 'Ibu ' . $faker->name('female'),
                        'label_ortu_pria' => 'Putra Pertama Dari',
                        'label_ortu_wanita' => 'Putri Bungsu Dari',
                        'tanggal_akad' => '2026-12-20 09:00:00',
                        'tanggal_resepsi' => '2026-12-20 11:00:00',
                        'tempat_akad' => 'Masjid ' . $faker->city,
                        'alamat_akad' => $faker->address,
                        'tempat_resepsi' => 'Ballroom ' . $faker->company,
                        'alamat_resepsi' => $faker->address,
                        'maps' => 'https://goo.gl/maps/example',
                        'music' => "demo/{$catalog->slug}/music.mp3",
                        'dynamic_photos' => $photos,
                        'love_stories' => [
                            [
                                'year' => '2024',
                                'title' => 'First Encounter',
                                'story' => 'Semua bermula dari pertemuan yang tak disengaja. Di antara hiruk pikuk kota, takdir mempertemukan dua jiwa yang awalnya asing menjadi satu tujuan. Sebuah percakapan sederhana yang ternyata menjadi awal dari segalanya.'
                            ],
                            [
                                'year' => '2025',
                                'title' => 'The Commitment',
                                'story' => 'Setelah melewati banyak tawa dan cerita, kami memutuskan untuk melangkah lebih jauh. Di depan keluarga dan kerabat, janji suci diucapkan sebagai bukti ketulusan untuk saling menjaga dan mendampingi hingga hari tua.'
                            ],
                            [
                                'year' => '2026',
                                'title' => 'Forever Starts Today',
                                'story' => 'Hari ini adalah lembaran baru dalam buku kehidupan kami. Bukan tentang akhir dari pencarian, melainkan awal dari petualangan indah untuk membangun rumah tangga yang penuh cinta, keberkahan, dan kebahagiaan abadi.'
                            ],
                        ],
                        'gifts' => [
                            ['bank_name' => 'BCA', 'account_number' => $faker->bankAccountNumber, 'account_name' => $groomFirstName],
                        ]
                    ]
                ]
            );
        }
    }
}
