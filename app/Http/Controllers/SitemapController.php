<?php
namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Produk;
use App\Models\Setting;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $staticPages = [
            ['/', '0.9', 'daily'],
            ['/about', '0.6', 'monthly'],
            ['/produk', '0.8', 'daily'],
            ['/blog', '0.8', 'daily'],
            ['/galeri', '0.5', 'monthly'],
            ['/testimoni', '0.5', 'monthly'],
            ['/faq', '0.5', 'monthly'],
            ['/kontak', '0.6', 'monthly'],
            ['/cara-pesan', '0.5', 'monthly'],
            ['/privasi', '0.3', 'yearly'],
        ];

        $sitemap = Sitemap::create();

        foreach ($staticPages as [$path, $priority, $frequency]) {
            $sitemap->add(
                Url::create(url($path))
                    ->setPriority($priority)
                    ->setChangeFrequency($frequency)
            );
        }

        Produk::where('is_active', true)
            ->latest('updated_at')
            ->get()
            ->each(function (Produk $p) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('produk.show', $p->slug))
                        ->setLastModificationDate($p->updated_at)
                        ->setPriority(0.8)
                        ->setChangeFrequency('weekly')
                );
            });

        Artikel::where('is_published', true)
            ->latest('updated_at')
            ->get()
            ->each(function (Artikel $a) use ($sitemap) {
                $sitemap->add(
                    Url::create(route('blog.show', $a->slug))
                        ->setLastModificationDate($a->published_at ?? $a->updated_at)
                        ->setPriority(0.7)
                        ->setChangeFrequency('weekly')
                );
            });

        return response($sitemap->render(), 200, ['Content-Type' => 'application/xml']);
    }

    public function robots()
    {
        $default = "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml');
        $content = Setting::getValue('ROBOTS_TXT', $default) ?: $default;

        return response($content, 200, ['Content-Type' => 'text/plain']);
    }
}
