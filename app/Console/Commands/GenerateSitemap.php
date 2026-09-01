<?php

namespace App\Console\Commands;

use App\Models\Catalog;
use Illuminate\Console\Command;
use Spatie\Sitemap\Tags\Url;


class GenerateSitemap extends Command
{
    // Nama perintah yang akan dipanggil di terminal
    protected $signature = 'sitemap:generate';

    // Deskripsi perintah
    protected $description = 'Generate the dynamic sitemap for Voeu';

    public function handle()
    {
        $this->info('Generating sitemap...');

        // Cara 1: Crawling otomatis (Paling simpel)
        // SitemapGenerator::create(config('app.url'))
        //     ->writeToFile(public_path('sitemap.xml'));

        // Cara 2: Manual (Lebih detail untuk SEO)
        $sitemap = \Spatie\Sitemap\Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)->setLastModificationDate(now()))
            ->add(Url::create('/#promo')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)->setLastModificationDate(now()))
            ->add(Url::create('/#catalog')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)->setLastModificationDate(now()));

        // Tambahkan semua produk katalog dari database
        Catalog::all()->each(function (Catalog $catalog) use ($sitemap) {
            $sitemap->add(
                Url::create("/v/demo-{$catalog->slug}")
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setLastModificationDate($catalog->updated_at)
            );
        });


        $sitemap->writeToFile(public_path('sitemap.xml'));


        $this->info('Sitemap generated successfully!');
    }
}
