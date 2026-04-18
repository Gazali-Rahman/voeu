<?php

namespace Database\Seeders;

use App\Models\Invitation;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoInvitationSeeder extends Seeder
{
    public function run()
    {
        $catalogs = Catalog::all();
        $admin = User::first();

        // Inisialisasi Faker dengan lokalisasi Indonesia
        $faker = \Faker\Factory::create('id_ID');

        foreach ($catalogs as $catalog) {
            // Generate Nama Unik tiap kali loop
            $groomFirstName = $faker->firstNameMale;
            $groomLastName = $faker->lastNameMale;
            $brideFirstName = $faker->firstNameFemale;
            $brideLastName = $faker->lastNameFemale;

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
                        'nama_ortu_pria' => 'Bpk. ' . $faker->name('male') . ' & Ibu ' . $faker->name('female'),
                        'nama_ortu_wanita' => 'Bpk. ' . $faker->name('male') . ' & Ibu ' . $faker->name('female'),
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
                        'dynamic_photos' => [
                            ['label' => 'c1', 'path' => "demo/{$catalog->slug}/c1.png"],
                            ['label' => 'c2', 'path' => "demo/{$catalog->slug}/c2.png"],
                            ['label' => 'bridge', 'path' => "demo/{$catalog->slug}/bridge.png"],
                            ['label' => 'groom', 'path' => "demo/{$catalog->slug}/groom.png"],
                            ['label' => 'gallery1', 'path' => "demo/{$catalog->slug}/gallery1.png"],
                            ['label' => 'gallery2', 'path' => "demo/{$catalog->slug}/gallery2.png"],
                            ['label' => 'gallery3', 'path' => "demo/{$catalog->slug}/gallery3.png"],
                            ['label' => 'gallery4', 'path' => "demo/{$catalog->slug}/gallery4.png"],
                            ['label' => 'gallery5', 'path' => "demo/{$catalog->slug}/gallery5.png"],
                            ['label' => 'gallery6', 'path' => "demo/{$catalog->slug}/gallery6.png"],
                        ],
                        'love_stories' => [
                            ['year' => '2024', 'title' => 'First Meet', 'story' => 'Pertemuan yang tak sengaja di ' . $faker->city],
                            ['year' => '2025', 'title' => 'Engagement', 'story' => 'Lamaran yang tak terlupakan di ' . $faker->city],
                            ['year' => '2026', 'title' => 'Wedding', 'story' => 'Pernikahan yang penuh cinta di ' . $faker->city],
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
